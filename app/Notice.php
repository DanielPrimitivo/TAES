<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function coordinate() {
        return $this->hasOne('App\Coordinate');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function times(){
        return $this->hasMany('App\Time');
    }
}
