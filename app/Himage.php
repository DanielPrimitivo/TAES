<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Himage extends Model
{
    public function user() {
        // Himage tiene la clave ajena 'user_id'
        return $this->belongsTo('App\User');
    }

    public function hnotice() {
        // Himage tiene la clave ajena 'hnotice_id'
        return $this->belongsTo('App\Hnotice');
    }
}
