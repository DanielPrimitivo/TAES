<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Weather;

class Hweather extends Model
{
    public function hnotice() {
        // Hweather tiene la clave ajena 'hnotice_id'
        return $this->belongsTo('App\Hnotice');
    }

    // Creación de un tiempo
    public function createHWEATH(Weather $weather, int $id) {
        $hweather = new Hweather();

        $hweather->viento = $weather->viento;
        $hweather->dirviento = $weather->dirviento;
        $hweather->humedad = $weather->humedad;
        $hweather->temperatura = $weather->temperatura;
        $hweather->lluvia = $weather->lluvia;
        $hweather->fecha = $weather->fecha;
        $hweather->hnotice_id = $id;

        $hweather->save();
    }

    // Lectura de un tiempo
    public function readHWEATH(int $id) {
        $weather = Hweather::find($id);

        return $weather;
    }

    // Lectura de todos los tiempos
    public function readAll() {
        $weathers = Hweather::all();

        return $weathers;
    }

    // Actualización de un tiempo
    public function updateHWEATH() {

    }

    // Eliminación de un tiempo
    public function deleteHWEATH(int $id) {
        $weather = Hweather::find($id);
        $weather->delete();
    }
}
