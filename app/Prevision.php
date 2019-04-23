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
    public function createPREV(array $data) {
        $prevision = new Prevision();

        $prevision->rango_hora = $data['rango_hora'];
        $prevision->viento = $data['viento'];
        $prevision->dirviento = $data['dirviento'];
        $prevision->humedad = $data['humedad'];
        $prevision->temperatura = $data['temperatura'];
        $prevision->lluvia = $data['lluvia'];
        $prevision->fecha = $data['fecha'];

        $prevision->save();
    }

    // Lectura de una prevision
    public function readPREV(int $id) {
        $prevision = Prevision::find($id);

        return $prevision;
    }

    // Lectura de todas las previsiones
    public function readAll() {
        $prevision = Prevision::all();

        return $prevision;
    }

    // Actualización de una previsione
    public function updatePREV() {

    }

    // Eliminación de una prevision
    public function deletePREV(int $id) {
        $prevision = Prevision::find($id);
        $prevision->delete();
    }
}
