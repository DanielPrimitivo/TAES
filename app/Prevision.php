<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prevision extends Model
{
    public function weather() {
        // Prevision tiene la clave ajena 'weather_id'
        return $this->belongsTo('App\Weather');
    }    
}
