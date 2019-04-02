<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HImage extends Model
{
    public function hcoordinate() {
        //Image tiene la clave ajena de Coordinate
        return $this->belongsTo('App\HCoordinate');
    }

    public function hnotice() {
        //Image tiene la clave ajena de Notice
        return $this->belongsTo('App\HNotice');
    }
}
