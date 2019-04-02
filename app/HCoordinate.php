<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HCoordinate extends Model
{
    public function himage() {
        return $this->hasOne('App\HImage');
    }

    public function hnotice() {
        //Coordinate tiene la clave ajena de Notice
        return $this->belongsTo('App\HNotice');
    }
}
