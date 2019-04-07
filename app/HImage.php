<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HImage extends Model
{
    public function hcoordinate() {
        //Image tiene la clave ajena de Coordinate
        return $this->belongsTo('App\HCoordinate');
    }

    public function hnotice() {
        //Image tiene la clave ajena de Notice
        return $this->belongsTo('App\HNotice');
    }

    public static function create(array $data){
        $t = new HImage();
        $t->fecha = $data['fecha'];
        $t->url = $data['url'];
        $t->hnotice_id = $data['hnotice_id'];
        $t->hcoordinate_id = $data['hcoordinate_id'];
        $t->save();
        return redirect()->route('himages');
    }

    public static function crear(){
        return view('himage.himagecreate');
    }

    public static function upgrade(array $data, HImage $himage){
        $himage->update($data);
        return redirect()->route('himage.details', ['himage' => $himage]);
    }

    public static function eliminar(HImage $himage){
        $himage->delete();
        return redirect()->route('himages.list');
    }
}
