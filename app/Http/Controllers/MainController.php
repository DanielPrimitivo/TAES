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

    public function getNoticeImages() {
        $images = Image::readAll();
        return response()->json(array('images' => $images), 200);
    }
}
