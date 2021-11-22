<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parámetro para que en su lugar lo devuelva como array.

        //VALIDAR LOS DATOS

        $usuario = new Usuario();

        $usuario->nombre = $datos->nombre;
        $usuario->foto = $datos->foto;
        $usuario->email = $datos->email;
        $usuario->contraseña = $datos->contraseña;

        if(isset($datos->email))
            $usuario->email = $datos->email;

        //Escribir en la base de datos
        try{
            $usuario->save();
            $respuesta['msg'] = "Usuario guardado con id ".$usuario->id;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }


    public function borrar($id){

        $respuesta = ["status" => 1, "msg" => ""];

        //Buscar a la usuario
        try{
            $usuario = Usuario::find($id);

            if($usuario){
                    $usuario->delete();
                    $respuesta['msg'] = "Usuario borrado";
            }else{
                $respuesta["msg"] = "Usuario no encontrado";
                $respuesta["status"] = 0;
            }
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }


    public function editar(Request $req,$id){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        //VALIDAR EL JSON

        $datos = json_decode($datos); //Se interpreta como objeto. Se puede pasar un parámetro para que en su lugar lo devuelva como array.


        //Buscar a la usuario
        try{
            $usuario = Usuario::find($id);

            if($usuario){

                //VALIDAR LOS DATOS

                if(isset($datos->nombre))
                    $usuario->nombre = $datos->nombre;
                if(isset($datos->foto))
                    $usuario->foto = $datos->foto;
                if(isset($datos->email))
                    $usuario->email = $datos->email;
                if(isset($datos->contraseña))
                    $usuario->contraseña = $datos->contraseña;

                //Escribir en la base de datos
                    $usuario->save();
                    $respuesta['msg'] = "Usuario actualizado.";
            }else{
                $respuesta["msg"] = "Usuario no encontrado";
                $respuesta["status"] = 0;
            }
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

    public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $usuario = Usuario::all();
            $respuesta['datos'] = $usuario;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

    public function ver($id){
        $respuesta = ["status" => 1, "msg" => ""];


        //Buscar a la usuario
        try{
            $usuario = Usuario::find($id);
            $usuario->makeVisible(['direccion','updated_at']);
            $respuesta['datos'] = $usuario;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
}
