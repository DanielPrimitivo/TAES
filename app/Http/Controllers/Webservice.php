<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Image;
use APP\Coordinate;

class Webservice extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guaradar la imagen en public/imagenes
        $imagen = new Image;
        $fimagen = fopen('public/imagenes/' . $imagen->id . 'jpg', 'w');
        fwrite($fimagen, json_decode($request->imagen));
        fclose($fimagen);

        //Obtener los metadatos de la imagen
        $datosimagen = exif_read_data('public/imagenes/' . $imagen->id . 'jpg');
        $longitud = getGPS($datosimagen["GPSLongitude"], $datosimagen["GPSLongitudeRef"]);
        $latitud = getGPS($datosimagen["GPSLatitude"], $datosimagen["GPSLatitudeRef"]);
        $fecha = $datosimagen["DateTimeOriginal"];
        $url = 'public/imagenes/' . $imagen->id . 'jpg';

        //Crear y guardar la coordenada de la imagen
        $coordenada = new Coordinate;
        $coordenada->x = $longitud;
        $coordenada->y = $latitud;
        $coordenada->save();

        //Anadir los datos de la imagen y guardarlos
        $imagen->fecha = $fecha;
        $imagen->url = $url;

        $imagen->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //Funcion para consegui la latitud/longitud
    private function getGPS($exifCoord, $hemisferio){
        $grados = count($exifCoord ) > 0 ? gps2num(exifCoord[0]) : 0;
        $minutos = count($exifCoord ) > 1 ? gps2num(exifCoord[1]) : 0;
        $segundos = count($exifCoord ) > 2 ? gps2num(exifCoord[2]) : 0;

        $flip = ($hemisferio == 'W' or $hemisferio == 'S') ? -1 : 1;

        return $flip * ($grados + $minutos / 60 + $segundos / 3600);
    }

    //Funcion necesaria para conseguir la grados/segundos/minutos de la coordenada
    private function gps2num($coordPart){
        $parts = explode('/', $coordPart);
        if(count($parts) <= 0){
            return 0;
        }

        if(count($parts) == 1){
            return $parts[0];
        }

        return floatval($parts[0]) / floatval($parts[1]);
    }
}
