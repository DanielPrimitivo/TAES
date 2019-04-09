<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    public function image() {
        return $this->hasOne('App\Image');
    }

    public function notice() {
        //Coordinate tiene la clave ajena de Notice
        return $this->belongsTo('App\Notice');
    }

    public static function create(array $data){
        $t = new Coordinate();
        $t->x = $data['x'];
        $t->y = $data['y'];
        $t->notice_id = $data['notice_id'];
        $t->save();
        return redirect()->route('coordinates');
    }

    public static function crear(){
        return view('coordinate.coordinatecreate');
    }

    public static function upgrade(array $data, Coordinate $c){
        $c->update($data);
        return redirect()->route('coordiniate.details', ['coordinate' => $c]);
    }

    public static function eliminar(Coordinate $c){
        $c->delete();
        return redirect()->route('coordiniates.list');
    }


    public function obtenerInformacion(int $id){
        $c = Coordiniate::where('id', '=', $id);
        return view('coordiniate.coordiniate', compact('c'));
    }

    // --------------------------------------------

    public function read() {
        return Coordinate::All();
    }

    public function guardar($request) {
        $coordinate = new Coordinate();
        $coordinate->x = $request->input('latitud');
        $coordinate->y = $request->input('longitud');
        $coordinate->notice_id = $request->input('notice_id');
        $coordinate->save();
    }
}
