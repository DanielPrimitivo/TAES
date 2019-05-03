<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\Weather;
use View;
use Carbon\Carbon;

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

        return view::make('Main/dashboard')->with('notices', $notices)->with('filtered', $categoria);
    }

    public function detallesAviso($id) {
        //$id = 3;
        $notice = Notice::readNOT($id);
        $images = $notice->images;
        $weather = $notice->weather;
        $previsions = $weather->previsions;

        return view::make('Main/aviso')->with('notice', $notice)->with('images', $images)->with('weather', $weather)->with('previsions', $previsions);
    }

    public function marcarVisto($id){
        Notice::marcarVisto($id);
        $notice = Notice::readNOT($id);

        return redirect()->route('aviso', ['id' => $id]);
    }

    public function cambiarCategoria(Request $request){
        $data = $request->all();
        $id = $data["id"];
        $new_cat = $data["newCat"];
        Notice::cambiarCategoria($id, $new_cat);

        return redirect()->route('aviso', ['id' => $id]);
    }
}
