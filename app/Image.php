<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image','sneaker_id'
    ];

    public function image()
    {
        return $this->belongsTo('App\Product');
    }
}
