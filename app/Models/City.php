<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parses(){
        return $this->belongsToMany(Parse::class, 'parse_cities','city_id','parse_id');
    }
}
