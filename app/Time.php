<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public function notice() {
        //Time tiene la clave ajena de Notice
        return $this->belongsTo('App\Notice');
    }
}
