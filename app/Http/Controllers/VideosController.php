<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosController extends CursosController
{
  	public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();


        $datos = json_decode($datos);


        $videos = new Usuario();

        $videos->titulo = $datos->titulo;
        $videos->foto = $datos->foto;
        $videos->enlace = $datos->enlace;

        try{
            $videos->save();
            $respuesta['msg'] = "Video guardado con id ".$videos->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
}
