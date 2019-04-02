<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    public function image() {
        return $this->hasOne('App\Image');
    }

    public function notice() {
        //Coordinate tiene la clave ajena de Notice
        return $this->belongsTo('App\Notice');
    }
}
