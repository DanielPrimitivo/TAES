<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;


class NoticeController extends Controller
{   
    
    public function show(Notice $notice) {
        return Notice::obtenerInformacion($notice);
    }

    public function create() {
        return Notice::crear();
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
        return Notice::create($data);
    }

    public function update(Notice $notice){
        $data = request();
        return Notice::upgrade($data, $notice);
    }

    public function destroy(Notice $notice){
        return Notice::eliminar($notice);
    }
}
