<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CursosController extends Controller
{
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();


        $datos = json_decode($datos);


        $curso = new Usuario();

        $curso->titulo = $datos->titulo;
        $curso->descripcion = $datos->descripcion;
        $curso->foto = $datos->foto;

        try{
            $curso->save();
            $respuesta['msg'] = "Curso guardado con id ".$curso->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

    public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $curso = Usuario::all();
            $respuesta['datos'] = $curso;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

}
