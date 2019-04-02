<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HTime extends Model
{
    public function hnotice() {
        //Time tiene la clave ajena de Notice
        return $this->belongsTo('App\HNotice');
    }
}
