<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class MainController extends Controller
{
    public function index() {
      return view::make('Main/dashboard');
    }
}
