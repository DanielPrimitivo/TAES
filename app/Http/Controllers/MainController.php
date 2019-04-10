<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Coordinate;

class MainController extends Controller
{
    public function index() {
      $coordinate = new Coordinate();
      $coordinates = $coordinate->read();

      return view::make('Main/dashboard')->with('coordinates', $coordinates);
    }

    public function aviso() {
      return view::make('Main/aviso');
    }
}
