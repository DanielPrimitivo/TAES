<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Sender;
use App\Notice;
use App\Weather;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TimeController;

class ImageController extends Controller
{   
    public static function reciveImage(array $data){
        if(Sender::exists($data['tlf'])){
            $sender = Sender::readByTlf($data['tlf']);
        }
        else{
            $datos = array(
                "tlf"  => $data['tlf'],
                "categoria"  => 'Ciudadano',
            );
            Sender::createSEN($datos);
            $sender = Sender::readByTlf($data['tlf']);
        }
        
        $notice_controll = new NoticeController();
        $id = $notice_controll->agruparAvisos($data['lat'], $data['long']);
        $time_controll = new TimeController();
        if($id != null){
            $datos_imagen = array("fecha" => $data['fecha'],
                                   "url" => $data['url'], 
                                    "lat" =>$data['lat'], 
                                    "long" => $data['long'], 
                                    "direccion" => $data['direccion'],
                                    "comentarios" => $data['comentarios'],
                                    "notice_id" => $id, 
                                    "sender_id" => $sender->id);
            Image::createIMG($datos_imagen);
        }
        else{
            $datos_notice = array("fecha" => $data['fecha'],
                                   "categoria" => $data['categoria_not'], 
                                   "visto" => 0,
                                   "lat" => $data['lat'], 
                                   "long" => $data['long']);

            $notice = Notice::createNOT($datos_notice);
            
            $datos_imagen = array("fecha" => $data['fecha'],
                                   "url" => $data['url'], 
                                    "lat" =>$data['lat'], 
                                    "long" => $data['long'], 
                                    "direccion" => $data['direccion'], 
                                    "comentarios" => $data['comentarios'],
                                    "notice_id" => $notice->id, 
                                    "sender_id" => $sender->id);

            Image::createIMG($datos_imagen);

            $time_controll->gestorTiempo($notice->id, $data['lat'], $data['long'], 0);
        }
    }

    public function generadorWS(){
        $datos_imagen = array("fecha" => '27/04/2019 - 11:09',
                                "url" => 'imagen50.jpg',
                                "categoria_not" => 'Incendio', 
                                "lat" => 50.387111, 
                                "long" => -0.5111661, 
                                "direccion" => 'Norte',
                                "comentarios" => 'Es un incendio',
                                "tlf" => 999999999);

        $this->reciveImage($datos_imagen);
    }

    public function agruparCategoria($categoria) {
        $images = Image::getByCategory($categoria);
        
        //return vista;
    }

    public function agruparCategoriaUsuario($id_notice, $categoria) {
        $images = Image::getByUserCategory($id_notice, $categoria);
        
        //return vista;
    }
}