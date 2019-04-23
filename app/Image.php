<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['fecha', 'url', 'lat', 'long', 'direccion'];
    
    public function user() {
        // Image tiene la clave ajena 'user_id'
        return $this->belongsTo('App\User');
    }

    public function notice() {
        // Image tiene la clave ajena 'notice_id'
        return $this->belongsTo('App\Notice');
    }

    // Creación de una imagen
    public function createIMG(array $data) {
        $image = new Image();

        $image->fecha = $data['fecha'];
        $image->url = $data['url'];
        $image->lat = $data['lat'];
        $image->long = $data['long'];
        $image->direccion = $data['direccion'];
        $image->notice_id = $data['notice_id'];
        $image->user_id = $data['user_id'];

        $image->save();
    }

    // Lectura de una imagen
    public function readIMG(int $id) {
        $image = Image::find($id);

        return $image;
    }

    // Lectura de todas las imagenes
    public function readAll() {
        $images = Image::all();

        return $images;
    }

    // Actualización de una imagen
    public function updateIMG() {

    }

    // Eliminación de una imagen
    public function deleteIMG(int $id) {
        $image = Image::find($id);
        $image->delete();
    }
}
