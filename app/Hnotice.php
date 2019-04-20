<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hnotice extends Model
{
    public function himages() {
        return $this->hasMany('App\Himage');
    }

    public function hweather() {
        return $this->hasOne('App\Hweather');
    }
}
