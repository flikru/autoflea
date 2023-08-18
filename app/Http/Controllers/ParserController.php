<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use App\Models\City;
use App\Models\Parse;
use App\Models\Brand;

class ParserController extends Controller
{

    public function parseAutoDetail(){
        $dom = new Dom;
        for($i=0; $i<=10;$i++):
            if($i<=1){
                $url = "https://avtorazborki.org/";
            }else{
                $url = "https://avtorazborki.org/$i.html";
            }
            $dom->loadFromUrl($url);
            $html = $dom->outerHtml;

            $contents = $dom->find('.razborki-list li');

            foreach ($contents as $key=>$content){
                //if($key==1) break;
                $explode = explode("<br />", $content);
                $city = explode(',',$explode[1])[0];
                if(strpos($city,'с.')!==false or strpos($city,'п.')!==false or strpos($city,'д.')!==false or strpos($city,'ст.')!==false) continue;

                $tagA = $content->find('a');
                $urlParse = "https://avtorazborki.org".$tagA->getAttribute('href');

                $domParse = new Dom;
                $domParse->loadFromUrl($urlParse);
                // $htmlParse = $dom->outerHtml;


                $nameParse = $domParse->find('h1')->text;
                $urlParse = $this->translit($domParse->find('h1')->text);
                $city = $domParse->find('.vcard .locality');

                $city = str_replace('г.','',$city->text);
                $city_tr = $this->translit($city);
                $dataCity=['title'=> $city,'city_url'=> $city_tr];
                $cityCreate = City::firstOrCreate($dataCity);



                $address = strip_tags($domParse->find('.vcard .adr'));
                if($domParse->find('.vcard .tel')){
                    $phone = strip_tags($domParse->find('.vcard .tel'));
                }

                if($domParse->find('.vcard .url')){
                    $website = $domParse->find('.vcard .url')->text;
                }
                if(!empty($domParse->find('.company .description'))){
                    $description = strip_tags($domParse->find('.company .description'));
                }

                $brands = $domParse->find('.withmodels ul li > a');

                $district='';

                $dataParse=[
                    'name'=> $nameParse,
                    'url'=> $urlParse,
                    'address'=> $address,
                    'phone'=> $phone,
                    'website'=> $website,
                    'district'=> $district,
                    'description'=> $description,
                ];

                $parseCreate = Parse::firstOrCreate($dataParse);
                $parseCreate->cities()->sync($cityCreate);


                foreach ($brands as $brand){
                    $brand = $brand->text;
                    $brandUrl = $this->translit($brand);
                    $dataBrand=["title" => $brand,"url" => $brandUrl];

                    $brandCreate = Brand::firstOrCreate($dataBrand);
                    $brandsAdd[] = $brandCreate->id;
                }
                $parseCreate->brands()->sync($brandsAdd);

                print_r('ok');
                echo '<br>';
            }
        endfor;
    }

    public function parseAuto(){
        $dom = new Dom;
        for($i=0; $i<=70;$i++):
            if($i<=1){
                $url = "https://avtorazborki.org/";
            }else{
                $url = "https://avtorazborki.org/$i.html";
            }
            $dom->loadFromUrl($url);
            $html = $dom->outerHtml;

            $contents = $dom->find('.razborki-list li');

            foreach ($contents as $content)
            {
                $title = $content->find('a')->text;
                $explode = explode("<br />", $content);
                $city = explode(',',$explode[1])[0];
                $city = str_replace('г.','',$city);
                if(strpos($city,'с.')!==false or strpos($city,'п.')!==false or strpos($city,'д.')!==false or strpos($city,'ст.')!==false) continue;

                $city_tr = $this->translit($city);
                if(isset($explode[2])){
                    $phone = strip_tags($explode[2]);
                }else{
                    $phone='';
                }


                $dataCity=[
                    'title'=> $city,
                    'city_url'=> $city_tr,
                ];

                $dataParse=[
                    'name'=> $content->find('a')->text,
                    'address'=> $explode[1],
                    'phone'=> $phone,
                ];

                $cityCreate = City::firstOrCreate($dataCity);
                $parseCreate = Parse::firstOrCreate($dataParse);

                $parseCreate->cities()->sync($cityCreate);

                //echo '<pre>';
               // print_r( $explode);
                // get the class attr
                $class = $content->getAttribute('class');

                // do something with the html
                $html2 = $content->innerHtml;

                // or refine the find some more
                $child   = $content->firstChild();
                $sibling = $child->nextSibling();
                //echo $html2;
            }
        endfor;
    }

    public function translit($s) {
        $s = (string) $s; // преобразуем в строковое значение
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = str_replace([' ','.',',','-','"',"'","»","«",")","("], '', $s);
        return $s; // возвращаем результат
    }
}
