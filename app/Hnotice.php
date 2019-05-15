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
    public static function createHNOT(Notice $notice) {
        $hnotice = new Hnotice();

        $hnotice->fecha = $notice->fecha;
        $hnotice->categoria = $notice->categoria;
        $hnotice->visto = $notice->visto;
        $hnotice->lat = $notice->lat;
        $hnotice->long = $notice->long;
        $hnotice->hect = $notice->hect;
        $hnotice->magn = $notice->magn;
        $hnotice->prec = $notice->prec;
        $hnotice->afect = $notice->afect;
        $hnotice->danyos = $notice->danyos;

        $hnotice->save();

        return $hnotice;
    }

    // Lectura de un aviso
    public static function readHNOT(int $id) {
        $notice = Hnotice::find($id);

        return $notice;
    }

    // Lectura de todos los avisos
    public static function readAll() {
        $notices = Hnotice::all();

        return $notices;
    }

    // Actualización de un aviso
    public static function updateHNOT() {
        
    }

    // Eliminación de un aviso
    public static function deleteHNOT(int $id) {
        $hnotice = Hnotice::find($id);
        $hnotice->delete();
    }
}
