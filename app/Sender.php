<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Image;

class Sender extends Model
{
    public function images() {
        return $this->hasMany('App\Image');
    }

     // Creación de un SENario
     public static function createSEN(array $data) {
        $sender = new Sender();

        $sender->tlf = $data['tlf'];
        $sender->categoria = $data['categoria'];

        $sender->save();
    }

    // Lectura de un SENario
    public static function readSEN(int $id) {
        $sender = Sender::find($id);

        return $sender;
    }

    // Lectura de todos los SENario
    public static function readAll() {
        $senders = Sender::all();

        return $senders;
    }

    // Actualización de un SENario
    public static function updateSEN() {
        
    }

    // Eliminación de un SENario
    public static function deleteSEN(int $id) {
        $sender = Sender::find($id);
        $sender->delete();
    }

    // Comprobar si un SENario existe
    public static function exists(string $tlf) {
        $sender = Sender::where('tlf', '=', $tlf)->get();

        if (count($sender) >= 1) {
            return true;
        }
        else {
            return false;
        }
    }

    // Lectura de un sender por tlf
    public static function readByTlf(string $tlf) {
        $sender = Sender::where('tlf', '=', $tlf)->get();

        return $sender;
    }
}
