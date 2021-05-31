<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use App\Usuario;
use Session;

class ColorController extends Controller
{
    public function index()
    {
        $request = Color::paginate(6);
        return response([
            'data' =>$request,
        ],200);
    }

    public function show($id){

        $request = Color::where('id',$id)->get();
        return response([
            'data'=>$request[0]
        ],200);
    }

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
