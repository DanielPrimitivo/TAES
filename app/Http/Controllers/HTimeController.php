<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HTime;


class HTimeController extends Controller
{   
    
    public function show(HTime $t) {
        return HTime::obtenerInformacion($t);
    }

    public function create() {
        return HTime::create();
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
        return HTime::crear($data);
    }

    public function update(HTime $htime){
        $data = request();
        return HTime::upgrade($data, $htime);
    }

    public function destroy(HTime $htime){
        return HTime::eliminar($htime);
    }
}
