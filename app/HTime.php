<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HTime extends Model
{
    public function hnotice() {
        //Time tiene la clave ajena de Notice
        return $this->belongsTo('App\HNotice');
    }

    public static function crear(array $data){
        $t = new HTime();
        $t->fecha = $data['fecha'];
        $t->viento = $data['viento'];
        $t->dirviento = $data['dirviento'];
        $t->humedad = $data['humedad'];
        $t->temperatura = $data['temperatura'];
        $t->lluvia = $data['lluvia'];
        $t->prevision = $data['prevision'];
        $t->hnotice_id = $data['hnotice_id'];
        $t->save();
        return redirect()->route('htimes');
    }

    public static function create(){
        return view('htime.htimecreate');
    }

    public static function upgrade(array $data, HTime $time){
        $time->update($data);
        return redirect()->route('htime.details', ['htime' => $time]);
    }

    public static function eliminar(HTime $time){
        $time->delete();
        return redirect()->route('htimes.list');
    }
}
