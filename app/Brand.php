<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'image','description','banner'
    ];

    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
