<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use Storage;
use Exception;

class Webservice extends Controller
{

	private function convertirGiroscopio($ejeX, $ejeY){
    	//
    	$var = 0;
    	return $var;
    }

	private function numImagenes(){
        static $numImagenes = 0;
        $valorRetorno = $numImagenes;
        $numImagenes++;
        return $valorRetorno;
    }

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
    	try{
	        //Guaradar la imagen en public/imagenes
	        $id = Webservice::numImagenes();
	        //file_put_contents('public/imagenes/' . $id . '.jpg', json_decode($request->imagen));
	        Storage::disk('imagenes')->put($id . '.jpg', json_decode($request->imagen));

	        //Obtener los metadatos de la imagen
	        $longitud = $request->longitud;
	        $latitud = $request->latitud;
	        $fecha = $request->fecha;
	        $ejeX = $request->ejeX;
	        $ejeY = $request->ejeY;
	        $direccion = Webservice::convertirGiroscopio($ejeX, $ejeY);
	        $url = $id . '.jpg';
	        $telefono = $request->telefono;
	        $categoria = $request->categoria;
	        $comentarios = $request->comentarios;


	        $datos = array('fecha' => $fecha, 'url' => $url, 'lat' => $latitud, 'long' => $longitud, 'direccion' => $direccion, 'categoria_not' => $categoria, 'tlf' => $telefono);

	        ImageController::reciveImage($datos);
	        $respuesta = ['respuesta' => 'ok'];
	        return response()->json($respuesta);
	    }
	    catch(Exception $e){
	    	$respuesta = ['respuesta' => 'nook'];
	        return response()->json($respuesta);
	    }
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
