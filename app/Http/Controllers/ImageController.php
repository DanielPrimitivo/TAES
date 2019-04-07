<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;


class ImageController extends Controller
{   
    
    public function show(Image $image) {
        return Image::obtenerInformacion($image);
    }

    public function create() {
        return Image::crear();
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
        return Image::create($data);
    }

    public function update(Image $image){
        $data = request();
        return Image::upgrade($data, $image);
    }

    public function destroy(Image $image){
        return Image::eliminar($image);
    }
}
