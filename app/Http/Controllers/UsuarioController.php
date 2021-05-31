<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Session;
class UsuarioController extends Controller
{
    
    public function login(){
        return view('login');
    }
    public function sesion(Request $request){
        $email = $request->email;

        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ]);

        $user = Usuario::where('email',$email)->where('password',$request->password)->get();

        if(count($user)==0){
            Session::flash('error', 'No se encontro usuarios con las credenciales ingresadas');
            return redirect()->route('login');
        }else{
            Session::put('tipo',$user[0]->tipo);
            Session::put('userMail',$user[0]->email);
            Session::put('password', $user[0]->password);
            return redirect()->route('inicio');
        }
    }
}
