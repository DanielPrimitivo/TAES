<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use Storage;
use Exception;
use App\Image;

class Webservice extends Controller
{

	private function convertirGiroscopio($ejeX, $ejeY){
    	//
    	$var = 0;
    	return $var;
    }

	private function numImagenes(){
        return Image::readAll()->count();
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
	        Storage::disk('imagenes')->put($id . '.jpg', base64_decode($request->imagen));

	        //Obtener los metadatos de la imagen
	        $longitud = $request->longitud;
	        $latitud = $request->latitud;
	        $fecha = $request->fecha;
	        $ejeX = $request->ejeX;
	        $ejeY = $request->ejeY;
	        $direccion = Webservice::convertirGiroscopio($ejeX, $ejeY);
	        $url = $id . '.jpg';
	        if(empty($request->telefono)){
	        	$respuesta = ['respuesta' => 'nook'];
	        	return response()->json($respuesta);
	        }
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
}
