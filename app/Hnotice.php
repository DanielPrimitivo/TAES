<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notice;

class Hnotice extends Model
{
    public function himages() {
        return $this->hasMany('App\Himage');
    }

    public function hweather() {
        return $this->hasOne('App\Hweather');
    }

    // Creación de un aviso
    public function createHNOT(Notice $notice) {
        $hnotice = new Hnotice();

        $hnotice->fecha = $notice->fecha;
        $hnotice->categoria = $notice->categoria;
        $hnotice->visto = $notice->visto;
        $hnotice->lat = $notice->lat;
        $hnotice->long = $notice->long;

        $hnotice->save();
    }

    // Lectura de un aviso
    public function readHNOT(int $id) {
        $notice = Hnotice::find($id);

        return $notice;
    }

    // Lectura de todos los avisos
    public function readAll() {
        $notices = Hnotice::all();

        return $notices;
    }

    // Actualización de un aviso
    public function updateHNOT() {
        
    }

    // Eliminación de un aviso
    public function deleteHNOT(int $id) {
        $hnotice = Hnotice::find($id);
        $hnotice->delete();
    }
}
