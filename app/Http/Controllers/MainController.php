<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Coordinate;
use App\Notice;
use App\Weather;
use App\Image;
use App\Sender;
Use App\Prevision;
use Carbon\Carbon;
use Gmopx\LaravelOWM\LaravelOWM;

class MainController extends Controller
{
    public function index() {
        $notices = Notice::orderBy('id', 'desc')->get();

        return view::make('Main/dashboard')->with('notices', $notices)->with('filtered', 'false')->with('lastCall', Carbon::now()->format('H:i'));
    }

    public function aviso() {
        return view::make('Main/aviso');
    }

    public function getNoticeTimes() {
        $data = request()->all();
        $notice = Notice::find($data["notice"]);
        $times = $notice->weather()->get();
        foreach($times as $time) {
            $time["lastActD"] = Carbon::parse($time->updated_at)->format('d-m-Y');
            $time["lastActH"] = Carbon::parse($time->updated_at)->format('H:i');
            $time["categoria"] = $notice->categoria;
        }
        return response()->json(array('times' => $times), 200);
    }

    public function getNoticePrevisions() {
        $data = request()->all();
        $notice = Notice::find($data["notice"]);
        $hourSpan = $data["hourSpan"];
        $time = $notice->weather()->first();
        $previsions = Prevision::searchPREV($time->id, $hourSpan);
        if($previsions->isEmpty()) {
          $newPrevisionArray = app('App\Http\Controllers\TimeController')->getWeather($notice->lat, $notice->long, $hourSpan);
          $newPrevisionArray['weather_id'] = $time->id;
          $newPrevisionArray['rango_hora'] = $hourSpan;
          Prevision::createPREV($newPrevisionArray);
        }
        $previsions = Prevision::searchPREV($time->id, $hourSpan);
        foreach($previsions as $prevision) {
          $prevision["lastActD"] = Carbon::parse($time->updated_at)->format('d-m-Y');
          $prevision["lastActH"] = Carbon::parse($time->updated_at)->format('H:i');
        }
        return response()->json(array('previsions' => $previsions), 200);
    }

    public function updateNoticePrevisions() {
      $data = request()->all();
      $notice = Notice::find($data["notice"]);
      $hourSpan = $data["hourSpan"];
      $time = $notice->weather()->first();
      $previsions = Prevision::searchPREV($time->id, $hourSpan);

      $newPrevisionArray = app('App\Http\Controllers\TimeController')->getWeather($notice->lat, $notice->long, $hourSpan);
      $newPrevisionArray['weather_id'] = $time->id;
      $newPrevisionArray['rango_hora'] = $hourSpan;

      foreach($previsions as $prevision) {
        Prevision::updatePREV($prevision->id ,$newPrevisionArray);
      }
      return response()->json(array('previsions' => $previsions), 200);
    }

    public function updateNoticeTime() {
        $data = request()->all();
        $notice = Notice::find($data["notice"]);
        $newWeatherArray = app('App\Http\Controllers\TimeController')->getWeather($notice->lat, $notice->long, 0);
        $newWeatherArray['notice_id'] = $notice->id;
        $times = $notice->weather()->get();
        foreach($times as $time) {
            Weather::updateWEATH($time->id, $newWeatherArray);
        }
        $times = $notice->weather()->get();
        foreach($times as $time) {
            $time["lastActD"] = Carbon::parse($time->updated_at)->format('d-m-Y');
            $time["lastActH"] = Carbon::parse($time->updated_at)->format('H:i');
            $time["categoria"] = $notice->categoria;
        }
        return response()->json(array('times' => $times), 200);
    }

    public function getAllImages() {
        $data = request()->all();
        $categoriaSelec = $data["categoria"];
        if($categoriaSelec == "false") {
          $images = Image::orderBy('id', 'desc')->get();
          foreach($images as $image) {
            $sender = $image->sender()->firstOrFail();
            $image->sender_id = $sender;
          }
          return response()->json(array('images' => $images), 200);
        }
        else {
          $images = Image::getByCategory($categoriaSelec);
          foreach($images as $image) {
            $sender = $image->sender()->firstOrFail();
            $image->sender_id = $sender;
          }
          rsort($images);
          return response()->json(array('images' => $images), 200);
        }

    }

    public function getNoticeImages() {
        $data = request()->all();
        $notice = Notice::find($data["notice"]);
        $senderCat = $data["categoria"];
        if($senderCat == "false") {
          $images = $notice->images()->orderBy('id', 'desc')->get();
          foreach($images as $image) {
            $sender = $image->sender()->firstOrFail();
            $image->sender_id = $sender;
          }
          return response()->json(array('images' => $images), 200);
        }
        else {
          $images = Image::getByUserCategory($notice->id, $senderCat);
          foreach($images as $image) {
            $sender = $image->sender()->firstOrFail();
            $image->sender_id = $sender;
          }
          return response()->json(array('images' => $images), 200);
        }
    }

    public function getPendingNotices() {
        $notices = Notice::where('visto', '0')->orderBy('id', 'desc')->get();

        return response()->json(array('notices' => $notices), 200);
    }

    public function getNotices() {
      $data = request()->all();
      $categoriaSelec = $data["categoria"];
      if($categoriaSelec == "false") {
        $notices = Notice::orderBy('id', 'desc')->get();
        foreach($notices as $notice) {
          $weather = $notice->weather()->firstOrFail();
          $notice["weather"] = $weather;
          $notice["numImg"] = $notice->images()->count();
        }
        return response()->json(array('notices' => $notices), 200);
      }
      else {
        $notices = Notice::getByCategory($categoriaSelec)->orderBy('id', 'desc')->get();
        foreach($notices as $notice) {
          $weather = $notice->weather()->firstOrFail();
          $notice["weather"] = $weather;
          $notice["numImg"] = $notice->images()->count();
        }
        return response()->json(array('notices' => $notices), 200);
      }
    }

    public function administrarSenders() {
      $senders = Sender::paginate(5);

      return view::make('Main/senders')->with('senders', $senders);
    }

    public function historic() {

      return view::make('Main/historic');
    }
}
