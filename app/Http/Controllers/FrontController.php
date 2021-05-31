<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Color;
use Session;

class FrontController extends Controller
{
    public function inicio(Request $request){

        $colores = Color::paginate(6);
        if($request->ajax()){
            return response()->json(view('controles-paginado',compact('colores'))->render());
        }
        return view('index')->with(['colores' => $colores,'session'=>\session()->get('tipo')]);
    }

    public function verColor($id)
    {
        if(Session::get('tipo')!="Administrador"){
            Session::flash('error', 'El usuario actual no tiene permisos de administrador');
            return redirect()->route('inicio');
        }else{
            return view('mostar');
        }
    }

    public function nuevo(){
        if(Session::get('tipo')!="Administrador"){
            Session::flash('error', 'El usuario actual no tiene permisos de administrador');
            return redirect()->route('inicio');
        }else{
            return view('nuevo');
        }
    }
}
