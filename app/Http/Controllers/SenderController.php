<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sender;

class SenderController extends Controller
{
    public function updateCat($id, $new_cat){
        Sender::updateCat($id, $new_cat);

        //return vista
    }
}
