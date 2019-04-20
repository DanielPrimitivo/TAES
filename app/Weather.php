<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    public function notice() {
        // Weather tiene la clave ajena 'notice_id'
        return $this->belongsTo('App\Notice');
    }

    public function previsions() {
        return $this->hasMany('App\Prevision');
    }
       
}
