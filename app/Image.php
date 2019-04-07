<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{   
    public function coordinate() {
        //Image tiene la clave ajena de Coordinate
        return $this->belongsTo('App\Coordinate');
    }

    public function notice() {
        //Image tiene la clave ajena de Notice
        return $this->belongsTo('App\Notice');
    }

    public static function create(array $data){
        $t = new Image();
        $t->fecha = $data['fecha'];
        $t->url = $data['url'];
        $t->notice_id = $data['notice_id'];
        $t->coordinate_id = $data['coordinate_id'];
        $t->save();
        return redirect()->route('images');
    }

    public static function crear(){
        return view('image.imagecreate');
    }

    public static function upgrade(array $data, Image $image){
        $image->update($data);
        return redirect()->route('image.details', ['image' => $image]);
    }

    public static function eliminar(Image $image){
        $image->delete();
        return redirect()->route('images.list');
    }
}
