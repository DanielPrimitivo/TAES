<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Sender;
use App\Notice;
use App\Http\Controllers\NoticeController;

class ImageController extends Controller
{   
    public function reciveImage(array $data){
        if(Sender::exists($data['tlf'])){
            $sender = Sender::readByTlf($data['tlf']);
        }
        else{
            $datos = array(
                "tlf"  => $data['tlf'],
                "categoria"  => $data['categoria'],
            );
            Sender::createSEN($datos);
            $sender = Sender::readByTlf($tlf);
        }
        
        $notice_controll = new NoticeController();
        $id = $notice_controll->agruparAvisos($data['lat'], $data['long']);
        if($id != null){
            $datos_imagen = array("fecha" => $data['fecha'],
                                   "url" => $data['url'], 
                                    "lat" =>$data['lat'], 
                                    "long" => $data['long'], 
                                    "direccion" => $data['direccion'], 
                                    "notice_id" => $id, 
                                    "sender_id" => $sender->id);
            Imagen::createIMG($datos_imagen);
        }
        else{
            $datos_notice = array("fecha" => $data['fecha'],
                                   "valoracion" => 0, 
                                   "visto" => 0,
                                   "lat" => $data['lat'], 
                                   "long" => $data['long']);

            $notice = Notice::createNOT($datos_notice);
            
            $datos_imagen = array("fecha" => $data['fecha'],
                                   "url" => $data['url'], 
                                    "lat" =>$data['lat'], 
                                    "long" => $data['long'], 
                                    "direccion" => $data['direccion'], 
                                    "notice_id" => $notice->id, 
                                    "sender_id" => $sender->id);

            Imagen::createIMG($datos_imagen);
        }
    }
}
