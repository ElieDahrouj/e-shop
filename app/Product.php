<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'brand', 'color','description','price','release_date','image','brand_id','actif'
    ];

    public function brand()
    {
        return $this->hasOne('App\Brand');
    }

    public function image()
    {
        return $this->hasMany('App\Image');
    }
}
