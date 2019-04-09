<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function coordinate() {
        return $this->hasOne('App\Coordinate');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function times(){
        return $this->hasMany('App\Time');
    }

    public static function create(array $data){
        $t = new Notice();
        $t->fecha = $data['fecha'];
        $t->valoracion = $data['valoracion'];
        $t->visto = $data['visto'];
        $t->save();
        return redirect()->route('notices');
    }

    public static function crear(){
        return view('notice.noticecreate');
    }

    public static function upgrade(array $data, Notice $notice){
        $notice->update($data);
        return redirect()->route('notice.details', ['notice' => $notice]);
    }

    public static function eliminar(Notice $notice){
        $notice->delete();
        return redirect()->route('notices.list');
    }

    // --------------------------------------------

    public function read() {
        return Notice::All();
    }
}
