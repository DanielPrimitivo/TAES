<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

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

    // Creación de una imagen
    public function createHIMG(Image $image, int $id) {
        $himage = new Himage();

        $himage->fecha = $image->fecha;
        $himage->url = $image->url;
        $himage->lat = $image->lat;
        $himage->long = $image->long;
        $himage->direccion = $image->direccion;
        $himage->hnotice_id = $id;
        $himage->user_id = $image->user_id;

        $himage->save();
    }

    // Lectura de una imagen
    public function readHIMG(int $id) {
        $image = Himage::find($id);

        return $image;
    }

    // Lectura de todas las imagenes
    public function readAll() {
        $images = Himage::all();

        return $images;
    }

    // Actualización de una imagen
    public function updateHIMG() {

    }

    // Eliminación de una imagen
    public function deleteHIMG(int $id) {
        $image = Himage::find($id);
        $image->delete();
    }
}
