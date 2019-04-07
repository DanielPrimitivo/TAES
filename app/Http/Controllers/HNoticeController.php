<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HNotice;


class HNoticeController extends Controller
{   
    
    public function show(HNotice $hnotice) {
        return HNotice::obtenerInformacion($hnotice);
    }

    public function create() {
        return HNotice::crear();
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
        return HNotice::create($data);
    }

    public function update(HNotice $hnotice){
        $data = request();
        return HNotice::upgrade($data, $hnotice);
    }

    public function destroy(HNotice $hnotice){
        return HNotice::eliminar($hnotice);
    }
}
