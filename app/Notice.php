<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function images() {
        return $this->hasMany('App\Image');
    }

    public function weather() {
        return $this->hasOne('App\Weather');
    }

    // Creación de un aviso
    public static function createNOT(array $data) {
        $notice = new Notice();

        $notice->fecha = $data['fecha'];
        $notice->valoracion = $data['valoracion'];
        $notice->visto = $data['visto'];
        $notice->lat = $data['lat'];
        $notice->long = $data['long'];

        $notice->save();

        return $notice;
    }

    // Lectura de un aviso
    public static function readNOT(int $id) {
        $notice = Notice::find($id);

        return $notice;
    }

    // Lectura de todos los avisos
    public static function readAll() {
        $notices = Notice::all();

        return $notices;
    }

    // Actualización de un aviso
    public static function updateNOT() {

    }

    // Eliminación de un aviso
    public static function deleteNOT(int $id) {
        $notice = Notice::find($id);
        $notice->delete();
    }
}