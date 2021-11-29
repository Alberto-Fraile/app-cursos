<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videos;

class VideosController extends Controller
{
  	public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();


        $datos = json_decode($datos);


        $videos = new Videos();

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

    
    public function ver($id){
        $respuesta = ["status" => 1, "msg" => ""];

        try{
            $videos = Videos::find($id);
            $videos->makeVisible(['direccion','updated_at']);
            $respuesta['datos'] = $videos;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

}
