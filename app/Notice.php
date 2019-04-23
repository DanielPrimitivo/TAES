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
    public function create(array $data) {
        $notice = new Notice();

        $notice->fecha = $data['fecha'];
        $notice->valoracion = $data['valoracion'];
        $notice->visto = $data['visto'];
        $notice->lat = $data['lat'];
        $notice->long = $data['long'];

        $notice->save();
    }

    // Lectura de un aviso
    public function read(int $id) {
        $notice = Notice::find($id);

        return $notice;
    }

    // Lectura de todos los avisos
    public function readAll() {
        $notices = Notice::all();

        return $notices;
    }

    // Actualización de un aviso
    public function update() {

    }

    // Eliminación de un aviso
    public function delete(int $id) {
        $notice = Notice::find($id);
        $notice->delete();
    }
}
