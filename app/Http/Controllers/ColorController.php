<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use App\Usuario;

class ColorController extends Controller
{
    /**
     * Muestra la lista de colores
     * @return Color en formato json
     */
    public function index()
    {
        $request = Color::paginate(6);
        return response([
            'data' =>$request,
        ],200);
    }
    /**
     * Muestra un color por su id
     *
     * @param  id
     * @return Color en formato json
     */
    public function show($id){

        $request = Color::where('id',$id)->get();
        return response([
            'data'=>$request[0]
        ],200);
    }
    /**
     * Guarda los cambios realizados
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id
     * @return Color en formato json
     */
    public function saveChanges(Request $request, $id)
    {
        $name = $request->name;
        $colors = $request->color;
        $pantone = $request->pantone;
        $year = $request->year;

        $usuario = Usuario::where('email',$request->userMail)->where('password',$request->passwd)->get();

        if(count($usuario)==0){
            return \response([
                "message"=>"Acceso denegado"
            ],200);
        }else{
            if($usuario[0]->tipo == "Administrador"){
                $color = Color::find($id);
                $color->name = $name;
                $color->color = $colors;
                $color->pantone = $pantone;
                $color->year = (int)$request->year;
                $color->save();
                return response([
                    'data'=>$color
                ],200);
            }else{
                return response([
                    "message" => "Acceso denegado"
                ],200);
            }
        }
    }
    /**
     * Crea un nuevo registro en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Color en formato json
     */
    public function save(Request $request){
        
        $usuario = Usuario::where('email',$request->userMail)->where('password',$request->passwd)->get();
        if(count($usuario)==0){
            return \response([
                "message"=>"Acceso denegado"
            ],200);
        }else{
            if($usuario[0]->tipo == "Administrador"){
                $color = new Color;
                $color->name = $request->name;
                $color->color = $request->color;
                $color->pantone = $request->pantone;
                $color->year = (int)$request->year;
                $color->save();
                return response([
                    'data'=>$color
                ],200);
            }else{
                return response([
                    "message" => "Acceso denegado"
                ],200);
            }
        }
    }
    /**
     * Elimina un registro de la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id
     * @return true
     * @return false
     */
    public function delete(Request $request,$id){
        $usuario = Usuario::where('email',$request->mail)->where('password',$request->pass)->get();
        if(count($usuario)==0){
            return \response([
                "message"=>"Acceso denegado"
            ],200);
        }else{
            if($usuario[0]->tipo == "Administrador"){
                $color = Color::destroy($id);
                return response([
                    'data'=>$color
                ],200);
            }else{
                return response([
                    "message" => "Acceso denegado"
                ],200);
            }
        }
    }
    /**
     * Muestra una lista de colores, aplicando un paginado definido por el usuario
     *
     * @param  \Illuminate\Http\Request  $reques
     * @return Color en formato json
     * @return Color en formato xml
     */
    public function listExterna(Request $request){

        $numItems = (int)$request->numItems;
        $tipoResponse = $request->tipoResponse;
        $colores = Color::paginate($numItems);

        if($tipoResponse == "json"){
            return \response(['data'=>$colores]);
        }
        if($tipoResponse == 'xml'){
            return response()->xml($colores);
        }
    }

}
