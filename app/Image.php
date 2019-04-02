<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{   
    public function coordinate() {
        //Image tiene la clave ajena de Coordinate
        return $this->belongsTo('App\Coordinate');
    }

    public function notice() {
        //Image tiene la clave ajena de Notice
        return $this->belongsTo('App\Notice');
    }
}
