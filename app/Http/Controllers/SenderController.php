<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sender;

class SenderController extends Controller
{
    public function updateCat(Request $request){
        $data = $request->all();
        $id = $data["senderid"];
        $new_cat = $data["newCat"];
        Sender::updateCat($id, $new_cat);

        return redirect()->route('manageSenders');
    }
}
