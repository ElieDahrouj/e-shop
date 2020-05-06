<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'image','summary','content','release_date','actif','author'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
