<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coordinate;


class CoordinateController extends Controller
{   
    
    public function show(Coordinate $coordinate) {
        return Coordinate::obtenerInformacion($coordinate);
    }

    public function create() {
        return Coordinate::crear();
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
        return Coordinate::create($data);
    }

    public function update(Coordinate $coordinate){
        $data = request();
        return Coordinate::upgrade($data, $coordinate);
    }

    public function destroy(Coordinate $coordinate){
        return Coordinate::eliminar($coordinate);
    }
}
