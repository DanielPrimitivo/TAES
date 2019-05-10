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
    public static function create(array $data) {
        $weather = new Weather();

        $weather->viento = $data['vientoVel'];
        $weather->dirviento = $data['vientoDir'];
        $weather->humedad = $data['humedad'];
        $weather->temperatura = $data['temperatura'];
        $weather->lluvia = $data['precipitaciones'];
        $weather->fecha = $data['fecha'];
        $weather->notice_id = $data['notice_id'];

        $weather->save();

        return $weather;
    }

    // Lectura de un tiempo
    public static function readWEATH(int $id) {
        $weather = Weather::find($id);

        return $weather;
    }

    // Lectura de todos los tiempos
    public static function readAll() {
        $weathers = Weather::all();

        return $weathers;
    }

    // Actualización de un tiempo
    public static function updateWEATH(int $id, array $data) {
        $weather = Weather::find($id);
        
        $weather->viento = $data['vientoVel'];
        $weather->dirviento = $data['vientoDir'];
        $weather->humedad = $data['humedad'];
        $weather->temperatura = $data['temperatura'];
        $weather->lluvia = $data['precipitaciones'];
        $weather->fecha = $data['fecha'];
        $weather->notice_id = $data['notice_id'];

        $weather->save();
    }

    // Eliminación de un tiempo
    public static function deleteWEATH(int $id) {
        $weather = Weather::find($id);
        $weather->delete();
    }

    public static function searchWEATH($notice_id) {
        $tiempo = Weather::where('notice_id', '=', $notice_id)->get();
        
        return $tiempo;
    }
}
