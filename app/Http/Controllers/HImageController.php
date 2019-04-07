<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HImage;


class HImageController extends Controller
{   
    
    public function show(HImage $himage) {
        return HImage::obtenerInformacion($himage);
    }

    public function create() {
        return HImage::crear();
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
        return HImage::create($data);
    }

    public function update(HImage $himage){
        $data = request();
        return HImage::upgrade($data, $himage);
    }

    public function destroy(HImage $himage){
        return HImage::eliminar($himage);
    }
}
