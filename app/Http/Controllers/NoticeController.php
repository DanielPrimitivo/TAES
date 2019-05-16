<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\Weather;
use App\Hnotice;
use App\Himage;
use App\Hweather;
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
        $notices = Notice::getByCategory($categoria)->get();

        return view::make('Main/dashboard')->with('notices', $notices)->with('filtered', $categoria)->with('lastCall', Carbon::now()->format('H:i'));
    }

    public function detallesAviso($id) {
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

    public function deleteNOT($id){
        Notice::deleteNOT($id);

        return View::make('Main/avisoEliminado');
    }

    public function agregarExtras(Request $request) {
        $data = $request->all();
        Notice::updateExtras($data);
        $notice = Notice::readNOT($data['id']);
        return view('')->with('notice', $notice);
    }

    public function calcularPrev($notice)  {
        $hnotices = Hnotice::readAll();
        $long = $notice->long;
        $lat = $notice->lat;
        $range = 1;
        $num = 0;
        $sum = 0;
        foreach($hnotices as $hnotice) {
            if ($hnotice->categoria == $notice->categoria) {
                $lat2 = $hnotice->lat;
                $long2 = $hnotice->long;
                $dis = rad2deg(acos((sin(deg2rad($lat2))*sin(deg2rad($lat))) +
                    (cos(deg2rad($lat2))*cos(deg2rad($lat))*cos(deg2rad($long2-$long)))));
                $dis_km = $dis * 111.13384;
                if ($dis_km < $range) {
                    $num = $num + 1;
                    if($notice->categoria == "inundacion")
                        $sum = $sum + $hnotice->prec;
                    else if ($notice->categoria == "incendio")
                        $sum = $sum + $hnotice->hect;
                }
            }
        }
        return $sum/$num;
    }

    public function calcularPrevAfect($notice) {
        $hnotices = Hnotice::readAll();
        $long = $notice->long;
        $lat = $notice->lat;
        $range = 1;
        $num = 0;
        $sum = 0;
        foreach($hnotices as $hnotice) {
            if ($hnotice->categoria == $notice->categoria) {
                $lat2 = $hnotice->lat;
                $long2 = $hnotice->long;
                $dis = rad2deg(acos((sin(deg2rad($lat2))*sin(deg2rad($lat))) +
                    (cos(deg2rad($lat2))*cos(deg2rad($lat))*cos(deg2rad($long2-$long)))));
                $dis_km = $dis * 111.13384;
                if ($dis_km < $range) {
                    $num = $num + 1;
                    if($notice->categoria == "terremoto") {
                        $magnh = $hnotice->magn;
                        $magn = $hnotice->magn;
                        $afecth = $hnotice->afect;
                        $prev = ($magn/$magnh)*$afecth;
                        $sum = $sum + $prev;
                    }
                    else
                        $sum = $sum + $hnotice->afect;
                }
            }
        }
        return $sum/$num;
    }

    public function calcularPrevDanyos($notice) {
        $hnotices = Hnotice::readAll();
        $long = $notice->long;
        $lat = $notice->lat;
        $range = 1;
        $num = 0;
        $sum = 0;
        foreach($hnotices as $hnotice) {
            if ($hnotice->categoria == $notice->categoria) {
                $lat2 = $hnotice->lat;
                $long2 = $hnotice->long;
                $dis = rad2deg(acos((sin(deg2rad($lat2))*sin(deg2rad($lat))) +
                    (cos(deg2rad($lat2))*cos(deg2rad($lat))*cos(deg2rad($long2-$long)))));
                $dis_km = $dis * 111.13384;
                if ($dis_km < $range) {
                    $num = $num + 1;
                    if($notice->categoria == "terremoto") {
                        $magnh = $hnotice->magn;
                        $magn = $hnotice->magn;
                        $danyosh = $hnotice->danyos;
                        $prev = ($magn/$magnh)*$danyosh;
                        $sum = $sum + $prev;
                    }
                    else
                        $sum = $sum + $hnotice->danyos;
                }
            }
        }
        return $sum/$num;
    }

    public function actualizarPrevExtras(Request $request) { //unicamente id
        $data = $request->all();
        $notice = Notice::readNOT($data['id']);
        $prevafect = $this->calcularPrevAfect($notice);
        $prevdanyos = $this->calcularPrevDanyos($notice);
        switch ($notice->categoria) {
            case "incendio":
                $prevhect = $this->calcularPrev($notice);
                $array = array(
                    'id' => $data['id'],
                    'prevhect' => $prevhect,
                    'prevafect' => $prevafect,
                    'prevdanyos' => $prevdanyos
                );
                break;

            case "inundacion":
                $prevprec = $this->calcularPrev($notice);
                $array = array(
                    'id' => $data['id'],
                    'prevprec' => $prevprec,
                    'prevafect' => $prevafect,
                    'prevdanyos' => $prevdanyos
                );
                break;

            default:
                $array = array(
                    'id' => $data['id'],
                    'prevafect' => $prevafect,
                    'prevdanyos' => $prevdanyos
                );
        }
        Notice::updatePrevExtras($array);
        $notice = Notice::readNOT($notice->id);
        return view('')->with('notice', $notice);
    }

    public function actualizarExtras(Request $request) {
        $data = $request->all();
        Notice::updateExtras($data);
        $notice = Notice::readNOT($data['id']);
        return view('')->with('notice', $notice);
    }

    public function actualizarMagnitud(Request $request) {
        $data = $request->all();
        Notice::updateMagn($data['id'],$data['magn']);
        $notice = Notice::readNOT($data['id']);
        return view('')->with('notice', $notice);
    }
 
    public static function archivar($id) {
        $notice = Notice::readNOT($id);
        $hnotice = Hnotice::createHNOT($notice);
        $images = $notice->images;

        foreach($images as $image) {
            Himage::createHIMG($image, $hnotice->id);
        }

        $weather = $notice->weather;
        Hweather::createHWEATH($weather, $hnotice->id);

        Notice::deleteNOT($id);

        return redirect()->route('dashboard');
    }
}
