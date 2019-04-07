<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;


class TimeController extends Controller
{   
    
    public function show(Time $t) {
        return Time::obtenerInformacion($t);
    }

    public function create() {
        return Time::create();
    }

    public function store(){ // Crear campeon
        // La validacion se debe de hacer en el controlador
       /* $data = request()->validate([
            'name' => ['required', 'unique:champions,name'],
            'rol' => 'required',
            'title' => 'required',
            'location' => 'required'
        ], [
            'name.required' => 'El campo nombre está mal',
            'rol.required' => 'El campo rol está mal',
            'title.required' => 'El campo titulo está mal',
            'location.required' => 'El campo localizacion está mal'
        ]);*/
        return Time::crear($data);
    }

    public function update(Time $time){
        $data = request();
        return Time::upgrade($data, $time);
    }

    public function destroy(Time $time){
        return Time::eliminar($time);
    }
}
