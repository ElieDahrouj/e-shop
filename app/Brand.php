<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Brand extends Model
{
    protected $fillable = [
        'name', 'image','description','banner'
    ];

    public function products()
    {
        return $this->hasMany('App\Product')->whereDate('release_date', '<=', Carbon::today()->toDateString())
            ->where('actif',1);
    }
}
