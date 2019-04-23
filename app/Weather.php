<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    public function notice() {
        // Weather tiene la clave ajena 'notice_id'
        return $this->belongsTo('App\Notice');
    }

    public function previsions() {
        return $this->hasMany('App\Prevision');
    }
     
    // Creación de un tiempo
    public function create(array $data) {
        $weather = new Weather();

        $weather->viento = $data['viento'];
        $weather->dirviento = $data['dirviento'];
        $weather->humedad = $data['humedad'];
        $weather->temperatura = $data['temperatura'];
        $weather->lluvia = $data['lluvia'];
        $weather->fecha = $data['fecha'];
        $weather->notice_id = $data['notice_id'];

        $weather->save();
    }

    // Lectura de un tiempo
    public function readWEATH(int $id) {
        $weather = Weather::find($id);

        return $weather;
    }

    // Lectura de todos los tiempos
    public function readAll() {
        $weathers = Weather::all();

        return $weathers;
    }

    // Actualización de un tiempo
    public function updateWEATH() {

    }

    // Eliminación de un tiempo
    public function deleteWEATH(int $id) {
        $weather = Weather::find($id);
        $weather->delete();
    }
}
