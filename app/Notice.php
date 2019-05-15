<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function images() {
        return $this->hasMany('App\Image');
    }

    public function weather() {
        return $this->hasOne('App\Weather');
    }

    // Creación de un aviso
    public static function createNOT(array $data) {
        $notice = new Notice();

        $notice->fecha = $data['fecha'];
        $notice->categoria = $data['categoria'];
        $notice->visto = $data['visto'];
        $notice->lat = $data['lat'];
        $notice->long = $data['long'];
        $notice->hect = -1; //cantidad de hectareas quemadas
        $notice->prevhect = -1; //prevision de hectareas quemadas (historicos)
        $notice->magn = -1.0; //magnitud escala Richter
        $notice->prec = -1; //cantidad de precipitaciones L/m^2
        $notice->prevprec = -1; //prevision de precipitaciones (historicos)
        $notice->afect = -1; //cantidad de personas afectadas
        $notice->prevafect = -1; //prevision de personas afectadas (historicos)
        $notice->danyos = -1; //cantidad en daños materiales 
        $notice->prevdanyos = -1; //prevision de cantidad de daños materiales (historicos)

        $notice->save();
        //Comprobar que $notice al devolverlo ya lleva su id
        return $notice;
    }

    // Lectura de un aviso
    public static function readNOT(int $id) {
        $notice = Notice::find($id);

        return $notice;
    }

    // Lectura de todos los avisos
    public static function readAll() {
        $notices = Notice::all();

        return $notices;
    }

    // Actualización de un aviso
    public static function updateNOT() {

    }

    // Añadir o actualizar datos extras al aviso
    public static function updateExtras(array $data) {
        $notice = Notice::find($data['id']);
        switch ($notice->categoria) {
            case "incendio":
                $notice->hect = $data['hect'];
                break;

            case "terremoto":
                $notice->magn = $data['magn'];
                break;

            case "inundacion":
                $notice->prec = $data['prec'];
                break;
            default:
                break;
        }
        $notice->afect = $data['afect'];
        $notice->danyos = $data['danyos'];
        $notice->save();
    }

    public static function updateMagn($id, $magn) { //agregar o actualizar solo magnitud
        $notice = Notice::find($id);
        $notice->magn = $magn;
        $notice->save();
    }

    public static function updatePrevExtras(array $data) { 
        $notice = Notice::find($data['id']);
        switch ($notice->categoria) {
            case "incendio":
                $notice->prevhect = $data['prevhect'];
                break;

            case "inundacion":
                $notice->prevprec = $data['prevprec'];
                break;

            default:
                break;
        }
        $notice->prevafect = $data['prevafect'];
        $notice->prevdanyos = $data['prevdanyos'];
        $notice->save();
    }

    // Eliminación de un aviso
    public static function deleteNOT(int $id) {
        $notice = Notice::find($id);
        $notice->delete();
    }

    public static function getByCategory($categoria) {
        $notices = Notice::where('categoria', '=', $categoria);

        return $notices;
    }

    public static function marcarVisto($id) {
        $notice = Notice::readNOT($id);
        if($notice->visto){
            $notice->visto = 0;
        }
        else{
            $notice->visto = 1;
        }

        $notice->save();
    }

    public static function cambiarCategoria($id, $new_cat){
        $notice = Notice::readNOT($id);
        $notice->categoria = $new_cat;
        $notice->save();
    }
}
