<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HCoordinate extends Model
{
    public function himage() {
        return $this->hasOne('App\HImage');
    }

    public function hnotice() {
        //Coordinate tiene la clave ajena de Notice
        return $this->belongsTo('App\HNotice');
    }

    public static function create(array $data){
        $t = new HCoordinate();
        $t->x = $data['x'];
        $t->y = $data['y'];
        $t->hnotice_id = $data['hnotice_id'];
        $t->save();
        return redirect()->route('hcoordinates');
    }

    public static function crear(){
        return view('hcoordinate.hcoordinatecreate');
    }

    public static function upgrade(array $data, HCoordinate $c){
        $c->update($data);
        return redirect()->route('hcoordiniate.details', ['hcoordinate' => $c]);
    }

    public static function eliminar(HCoordinate $c){
        $c->delete();
        return redirect()->route('hcoordiniates.list');
    }


    public function obtenerInformacion(int $id){
        $c = HCoordiniate::where('id', '=', $id);
        return view('hcoordiniate.hcoordiniate', compact('c'));
    }
}
