<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function user() {
        // Image tiene la clave ajena 'user_id'
        return $this->belongsTo('App\User');
    }

    public function notice() {
        // Image tiene la clave ajena 'notice_id'
        return $this->belongsTo('App\Notice');
    }
}
