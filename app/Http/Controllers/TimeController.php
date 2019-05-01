<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;


class TimeController extends Controller
{   
    public function getWeather(double $lat,double $lon,int $hours) {
        //llamar a la API para obtener el tiempo
        $lowm = new LaravelOWM();
        if($hours == 0) {
            $weather = $lowm->getCurrentWeather(array('lat' => $lat, 'lon' => $lon), 'metric', 'es');
        } else {
            $weather = $lowm->getWeatherForecast(array('lat' => $lat, 'lon' => $lon), 'metric', 'es', '', 1);
        }
        $array = array(
            'vientoVel' => $weather->wind->speed,
            'vientoDir' => $weather->wind->direction,
            'humedad' => $weather->humidity,
            'temperatura' => $weather->temperature,
            'temperaturaMin' => $weather->temperature->min,
            'temperaturaMax' => $weather->temperature->max,
            'precipitaciones' => $weather->precipitation,
            'presion' => $weather->pressure,
            'fecha' => $weather->lastUpdate
        );
        //$array['notice_id'] = $notice->id;

        return $array;
    }
}
