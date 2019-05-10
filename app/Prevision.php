<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prevision extends Model
{
    public function weather() {
        // Prevision tiene la clave ajena 'weather_id'
        return $this->belongsTo('App\Weather');
    }

    // Creación de una prevision
    public static function createPREV(array $data) {
        $prevision = new Prevision();

        $prevision->rango_hora = $data['rango_hora'];
        $prevision->viento = $data['vientoVel'];
        $prevision->dirviento = $data['vientoDir'];
        $prevision->humedad = $data['humedad'];
        $prevision->temperatura = $data['temperatura'];
        $prevision->lluvia = $data['precipitaciones'];
        $prevision->fecha = $data['fecha'];
        $prevision->weather_id = $data['weather_id'];

        $prevision->save();

        return $prevision;
    }

    // Lectura de una prevision
    public static function readPREV(int $id) {
        $prevision = Prevision::find($id);

        return $prevision;
    }

    // Lectura de todas las previsiones
    public static function readAll() {
        $prevision = Prevision::all();

        return $prevision;
    }

    // Actualización de una previsione
    public static function updatePREV(int $id, array $data) {
        $prevision = Prevision::find($id);

        $prevision->rango_hora = $data['rango_hora'];
        $prevision->viento = $data['vientoVel'];
        $prevision->dirviento = $data['vientoDir'];
        $prevision->humedad = $data['humedad'];
        $prevision->temperatura = $data['temperatura'];
        $prevision->lluvia = $data['precipitaciones'];
        $prevision->fecha = $data['fecha'];
        $prevision->weather_id = $data['weather_id'];

        $prevision->save();
    }

    // Eliminación de una prevision
    public static function deletePREV(int $id) {
        $prevision = Prevision::find($id);
        $prevision->delete();
    }

    public static function searchPREV($weather_id, $hours) {
        $prevision = Prevision::where('weather_id', '=', $weather_id)
                                ->where('rango_hora', '=', $hours)->get();
        
        return $prevision;
    }
}
