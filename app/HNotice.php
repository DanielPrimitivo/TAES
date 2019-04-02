<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HNotice extends Model
{
    public function hcoordinate() {
        return $this->hasOne('App\HCoordinate');
    }

    public function himages(){
        return $this->hasMany('App\HImage');
    }

    public function htimes(){
        return $this->hasMany('App\HTime');
    }
}
