<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;


class NoticeController extends Controller
{   
    public function agruparAvisos($lat, $long){
        $notices = Notice::readAll();
        $aux = 1; //km
        $elegido_id = null;

        foreach($notices as $notice){
            $lat_not = $notice->lat;
            $long_not = $notice->long;

            $dis = rad2deg(acos((sin(deg2rad($lat))*sin(deg2rad($lat_not))) + 
                    (cos(deg2rad($lat))*cos(deg2rad($lat_not))*cos(deg2rad($long-$long_not)))));
            $dis_km = $dis * 111.13384;

            if($dis_km < $aux){    
                $aux = $dis;
                $elegido_id = $notice->id;
            }
        }

        return $elegido_id;
    }
    
    public function agruparCategoria($categoria) {
        $notices = Notice::getByCategory($categoria);

        dd($notices);

        return $notices; // vista
    }
}
