<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use App\Weather;
use Carbon\Carbon;
use Cmfcmf\OpenWeatherMap\Exception;
use Gmopx\LaravelOWM\LaravelOWM;

class TimeController extends Controller
{   
    public function getWeather($lat, $lon, $hours) {
        //llamar a la API para obtener el tiempo
        $lowm = new LaravelOWM();
        try {
            if($hours == 0) {
                $weather = $lowm->getCurrentWeather(array('lat' => $lat, 'lon' => $lon), 'es', 'metric');
            } else {
                $forecast = $lowm->getWeatherForecast(array('lat' => $lat, 'lon' => $lon), 'es', 'metric', 1);
                $i = 0;
                foreach ($forecast as $forecastaux) {
                    $forecasts[$i] = $forecastaux;
                    $i=$i+1;
                }
                $cto = Carbon::createFromFormat('Y-m-d H:i:s.u', $forecasts[0]->time->to->format('Y-m-d H:i:s.u'));
                //$cto = new Carbon($forecasts[0]->time->to);
                if(Carbon::now()->greaterThan($cto)) {
                    switch ($hours) {
                        case 3: $weather = $forecasts[2];
                                break;
                        case 6: $weather = $forecasts[3];
                                break;
                        case 9: $weather = $forecasts[4];
                                break;
                    }
                } else {
                    switch ($hours) {
                        case 3: $weather = $forecasts[1];
                                break;
                        case 6: $weather = $forecasts[2];
                                break;
                        case 9: $weather = $forecasts[3];
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
                'fecha' => $weather->lastUpdate,
                'error' => false
            );
        } catch (Exception $ex) {
            $array = array(
                'vientoVel' => '',
                'vientoDir' => '',
                'humedad' => '',
                'temperatura' => '',
                'temperaturaMin' => '',
                'temperaturaMax' => '',
                'precipitaciones' => '',
                'presion' => '',
                'fecha' => '',
                'error' => true
            );
        }
        return $array;
    }

    public function gestorTiempo($id_notice, $lat, $lon, $hours) {
        $api = $this->getWeather($lat, $lon, $hours);

        //dd($api['fecha']->getTimestamp());

        if (!$api["error"]) {
            $array = array(
                'vientoVel' => $api['vientoVel']->getValue() * 3.6, //* 3.6 pasarlo a km/h
                'vientoDir' => $api['vientoDir']->getUnit(),
                'humedad' => $api['humedad']->getValue(),
                'temperatura' => $api['temperatura']->getValue(),
                'precipitaciones' => $api['precipitaciones']->getValue(),
                'fecha' => $api['fecha']
            );

            if ($hours == 0) {
                $array += ['notice_id'=> $id_notice];
                $res = Weather::searchWEATH($id_notice);
                if (count($res) == 0) {
                    $tiempo = Weather::create($array);
                }
                else {
                    Weather::updateWEATH($res->id, $array);
                }
            }
            else {
                $array += ['rango_hora' => $hours];

                $weather = Weather::searchWEATH($id_notice);
                $res = Prevision::searchPREV($weather->id);

                $array += ['weather_id'=> $weather->id];
                
                if (count($res) == 0) {
                    $prevision = Prevision::create($array);
                }
                else {
                    $prevision = Prevision::updatePREV($res->id, $array);
                }
            }
        }
        else {
            // Error
        }
    }
}
