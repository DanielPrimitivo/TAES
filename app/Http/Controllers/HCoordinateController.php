<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HCoordinate;


class HCoordinateController extends Controller
{   
    
    public function show(HCoordinate $hcoordinate) {
        return HCoordinate::obtenerInformacion($hcoordinate);
    }

    public function create() {
        return HCoordinate::crear();
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
        return HCoordinate::create($data);
    }

    public function update(HCoordinate $hcoordinate){
        $data = request();
        return HCoordinate::upgrade($data, $hcoordinate);
    }

    public function destroy(HCoordinate $hcoordinate){
        return HCoordinate::eliminar($hcoordinate);
    }
}
