<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use Carbon\Carbon;


class TimeController extends Controller
{   
    public function getWeather($lat, $lon, $hours) {
        //llamar a la API para obtener el tiempo
        $lowm = new LaravelOWM();
        if($hours == 0) {
            $weather = $lowm->getCurrentWeather(array('lat' => $lat, 'lon' => $lon), 'es', 'metric');
        } else {
            $forecast = $lowm->getWeatherForecast(array('lat' => $lat, 'lon' => $lon), 'es', 'metric', 1);
            $cto = new Carbon($forecast->forecasts[0]->time->to);
            if(Carbon::now()->greaterThan($cto)) {
                switch ($hours) {
                    case 3: $weather = $forecast->forecasts[2];
                            break;
                    case 6: $weather = $forecast->forecasts[3];
                            break;
                    case 9: $weather = $forecast->forecasts[4];
                            break;
                }
            } else {
                switch ($hours) {
                    case 3: $weather = $forecast->forecasts[1];
                            break;
                    case 6: $weather = $forecast->forecasts[2];
                            break;
                    case 9: $weather = $forecast->forecasts[3];
                            break;
                }
            }
        }
        $array = array(
            'vientoVel' => $weather->wind->speed,
            'vientoDir' => $weather->wind->direction,
            'humedad' => $weather->humidity,
            'temperatura' => $weather->temperature->now,
            'temperaturaMin' => $weather->temperature->min,
            'temperaturaMax' => $weather->temperature->max,
            'precipitaciones' => $weather->precipitation,
            'presion' => $weather->pressure,
            'fecha' => $weather->lastUpdate
        );
        return $array;
    }
}
