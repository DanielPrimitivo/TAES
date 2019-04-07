<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HNotice extends Model
{
    public function hcoordinate() {
        return $this->hasOne('App\HCoordinate');
    }

    public function himages(){
        return $this->hasMany('App\HImage');
    }

    public function htimes(){
        return $this->hasMany('App\HTime');
    }

    public static function create(array $data){
        $t = new HNotice();
        $t->fecha = $data['fecha'];
        $t->valoracion = $data['valoracion'];
        $t->visto = $data['visto'];
        $t->save();
        return redirect()->route('notices');
    }

    public static function crear(){
        return view('hnotice.hnoticecreate');
    }

    public static function upgrade(array $data, HNotice $notice){
        $notice->update($data);
        return redirect()->route('hnotice.details', ['hnotice' => $notice]);
    }

    public static function eliminar(HNotice $notice){
        $notice->delete();
        return redirect()->route('hnotices.list');
    }
}
