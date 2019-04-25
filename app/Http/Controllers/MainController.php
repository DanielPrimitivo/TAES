<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Coordinate;
use App\Notice;

class MainController extends Controller
{
    public function index() {
      $notices = Notice::take(4)->skip(0)->get();

      return view::make('Main/dashboard')->with('notices', $notices);
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
}
