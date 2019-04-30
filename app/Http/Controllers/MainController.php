<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Coordinate;
use App\Notice;
use App\Weather;
use Carbon\Carbon;
use Gmopx\LaravelOWM\LaravelOWM;

class MainController extends Controller
{
    public function index() {
        $notices = Notice::take(4)->skip(0)->get();

        return view::make('Main/dashboard')->with('notices', $notices)->with('filtered', 'false');
    }

    public function aviso() {
        return view::make('Main/aviso');
    }


    public function getNoticeTimes() {
        $data = request()->all();
        $notice = Notice::find($data["notice"]);

        //llamar a la API para obtener el tiempo
        $lowm = new LaravelOWM();
        $weather = $lowm->getCurrentWeather(array('lat' => $notice->lat, 'lon' => $notice->long), 'es');
        $array['viento'] = $weather->wind->speed;
        $array['dirviento'] = $weather->wind->direction;
        $array['humedad'] = $weather->humidity;
        $array['temperatura'] = $weather->temperature;
        $array['lluvia'] = $weather->precipitation;
        $array['fecha'] = $weather->lastUpdate;
        $array['notice_id'] = $notice->id;

        //actualizar el tiempo para el aviso y si no tenia crearlo
        $times = $notice->weather()->get();
        if ($times != null) {
            $notice->weather()->update($array);
            $times = $notice->weather()->get();
            
        } else {
            $times = new Weather();
            $times->create($array);
            $times = $notice->weather()->get();
        }

        return response()->json(array('times' => $times), 200);
    }
}
