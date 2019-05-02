<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Coordinate;
use App\Notice;
use App\Weather;
use App\Image;
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
        $times = $notice->weather()->get();
        return response()->json(array('times' => $times), 200);
    }

    public function getAllImages() {
        $images = Image::readAll();
        foreach($images as $image) {
          $sender = $image->sender()->firstOrFail();
          $image->sender_id = $sender;
        }
        return response()->json(array('images' => $images), 200);
    }

    public function getNoticeImages() {
        $data = request()->all();
        $notice = Notice::find($data["notice"]);
        $images = $notice->images()->get();
        foreach($images as $image) {
          $sender = $image->sender()->firstOrFail();
          $image->sender_id = $sender;
        }
        return response()->json(array('images' => $images), 200);
    }
}
