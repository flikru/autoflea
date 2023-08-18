<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded=[]; //Защита таблица от записи
    public function parses(){
        return $this->belongsToMany(Parse::class, 'parse_brands','brand_id','parse_id');
    }
}
