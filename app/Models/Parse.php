<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Brand;

class Parse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cities(){
        return $this->belongsToMany(City::class, 'parse_cities','parse_id','city_id');
    }
    public function brands(){
        return $this->belongsToMany(Brand::class, 'parse_brands','parse_id','brand_id');
    }
}
