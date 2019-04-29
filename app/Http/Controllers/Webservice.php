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
        $id = numImagenes();
        //$imagen->guardar();
        $fimagen = fopen('public/imagenes/' . $id . '.jpg', 'w');
        fwrite($fimagen, json_decode($request->imagen));
        fclose($fimagen);

        //Obtener los metadatos de la imagen
        $longitud = $request->longitud;
        $latitud = $request->latitud;
        $fecha = $request->fecha;
        $direccion = $request->direccion;
        $url = $id . '.jpg';
        $telefono = $request->telefono;
        $categoria = $request->categoria;

        $datos = array('fecha' => $fecha, 'url' => $url, 'lat' => $latitud, 'long' => $longitud, 'direccion' => $direccion, 'categoria_not' => $categoria, 'tlf' => $telefono);

        ImageController::recieveImage($datos);

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

    private function numImagenes(){
        static $numImagenes = 0;
        $valorRetorno = $numImagenes;
        $numImagenes++;
        return $valorRetorno;
    }
}
