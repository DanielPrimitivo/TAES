<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = array('viento', 'fecha', 'dirviento', 'humedad', 'temperatura', 'lluvia', 'prevision');
    
    public function notice() {
        //Time tiene la clave ajena de Notice
        return $this->belongsTo('App\Notice');
    }

    public static function crear(array $data){
        $t = new Time();
        $t->fecha = $data['fecha'];
        $t->viento = $data['viento'];
        $t->dirviento = $data['dirviento'];
        $t->humedad = $data['humedad'];
        $t->temperatura = $data['temperatura'];
        $t->lluvia = $data['lluvia'];
        $t->prevision = $data['prevision'];
        $t->save();
        return redirect()->route('times');
    }

    public static function create(){
        return view('time.timecreate');
    }

    public static function upgrade(array $data, Time $time){
        $time->update($data);
        return redirect()->route('time.details', ['time' => $time]);
    }

    public static function eliminar(Time $time){
        $time->delete();
        return redirect()->route('times.list');
    }


    public function obtenerInformacion(int $id){
        $t = Time::where('id', '=', $id);
        return view('time.time', compact('t'));
    }

    public function getFecha(int $id){
        $re = Time::where('id', '=', $id)->fecha;
    }

    public function setFecha(int $id, String $fecha){
        $t = Time::where('id', '=', $id);
        $re = new Time();
        $re->fecha = $fecha;
        $re->viento = $t['viento'];
        $re->dirviento = $t['dirviento'];
        $re->humedad = $t['humedad'];
        $re->temperatura = $t['temperatura'];
        $re->lluvia = $t['lluvia'];
        $re->prevision = $t['prevision'];
        $t->update($re);
    }

    public function getViento(int $id){
        $re = Time::where('id', '=', $id)->viento;
    }

    public function setViento(int $id, String $viento){
        $t = Time::where('id', '=', $id);
        $re = new Time();
        $re->fecha = $t['fecha'];
        $re->viento = $viento;
        $re->dirviento = $t['dirviento'];
        $re->humedad = $t['humedad'];
        $re->temperatura = $t['temperatura'];
        $re->lluvia = $t['lluvia'];
        $re->prevision = $t['prevision'];
        $t->update($re);
    }

    public function getHumedad(int $id){
        $re = Time::where('id', '=', $id)->humedad;
    }

    public function setHumedad(int $id, String $humedad){
        $t = Time::where('id', '=', $id);
        $re = new Time();
        $re->fecha = $t['fecha'];
        $re->viento = $t['viento'];
        $re->dirviento = $t['dirviento'];
        $re->humedad = $humedad;
        $re->temperatura = $t['temperatura'];
        $re->lluvia = $t['lluvia'];
        $re->prevision = $t['prevision'];
        $t->update($re);
    }

    public function getTemperatura(int $id){
        $re = Time::where('id', '=', $id)->temperatura;
    }

    public function setTemperatura(int $id, String $temperatura){
        $t = Time::where('id', '=', $id);
        $re = new Time();
        $re->fecha = $t['fecha'];
        $re->viento = $t['viento'];
        $re->dirviento = $t['dirviento'];
        $re->humedad = $t['humedad'];
        $re->temperatura = $temperatura;
        $re->lluvia = $t['lluvia'];
        $re->prevision = $t['prevision'];
        $t->update($re);
    }

    public function getLluvia(int $id){
        $re = Time::where('id', '=', $id)->lluvia;
    }

    public function setLluvia(int $id, String $lluvia){
        $t = Time::where('id', '=', $id);
        $re = new Time();
        $re->fecha = $t['fecha'];
        $re->viento = $t['viento'];
        $re->dirviento = $t['dirviento'];
        $re->humedad = $t['humedad'];
        $re->temperatura = $t['temperatura'];
        $re->lluvia = $lluvia;
        $re->prevision = $t['prevision'];
        $t->update($re);
    }

    public function getDirViento(int $id){
        $re = Time::where('id', '=', $id)->dirviento;
    }

    public function setDirViento(int $id, String $dir){
        $t = Time::where('id', '=', $id);
        $re = new Time();
        $re->fecha = $t['fecha'];
        $re->viento = $t['viento'];
        $re->dirviento = $dir;
        $re->humedad = $t['humedad'];
        $re->temperatura = $t['temperatura'];
        $re->lluvia = $t['lluvia'];
        $re->prevision = $t['prevision'];
        $t->update($re);
    }

    public function getPrevision(int $id){
        $re = Time::where('id', '=', $id)->prevision;
    }

    public function setPrevision(int $id, String $prev){
        $t = Time::where('id', '=', $id);
        $re = new Time();
        $re->fecha = $t['fecha'];
        $re->viento = $t['viento'];
        $re->dirviento = $t['dirviento'];
        $re->humedad = $t['humedad'];
        $re->temperatura = $t['temperatura'];
        $re->lluvia = $t['lluvia'];
        $re->prevision = $prev;
        $t->update($re);
    }
}
