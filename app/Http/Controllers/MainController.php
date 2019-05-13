<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Coordinate;
use App\Notice;
use App\Weather;
use App\Image;
use App\Sender;
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
        }
        return response()->json(array('times' => $times), 200);
    }

    public function updateNoticeTime() {
        $data = request()->all();
        $notice = Notice::find($data["notice"]);
        $times = $notice->weather()->get();
        $newWeatherArray = app('App\Http\Controllers\TimeController')->getWeather($notice->lat, $notice->long, 0);
        $newWeatherArray['notice_id'] = $notice->id;
        foreach($times as $time) {
            Weather::updateWEATH($time->id, $newWeatherArray);
            $time["lastActD"] = Carbon::parse($time->updated_at)->format('d-m-Y');
            $time["lastActH"] = Carbon::parse($time->updated_at)->format('H:i');
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
        }
        return response()->json(array('notices' => $notices), 200);
      }
      else {
        $notices = Notice::getByCategory($categoriaSelec)->orderBy('id', 'desc')->get();
        foreach($notices as $notice) {
          $weather = $notice->weather()->firstOrFail();
          $notice["weather"] = $weather;
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
