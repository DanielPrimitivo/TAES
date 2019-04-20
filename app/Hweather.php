<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hweather extends Model
{
    public function hnotice() {
        // Hweather tiene la clave ajena 'hnotice_id'
        return $this->belongsTo('App\Hnotice');
    }
}
