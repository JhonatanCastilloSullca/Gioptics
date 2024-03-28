<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Inicio;
use Illuminate\Http\Request;
use Carbon\Carbon;  
use Auth;
use DB;

class LoginController extends Controller
{   
    public function showLoginForm(){
        $sucursales=DB::table('sucursals')
        ->orderBy('sucursals.id','desc')
        ->get();

        return view('auth.login',compact('sucursales'));
    }

    public function login(Request $request){

        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('usuario', 'password');

        if (Auth::attempt($credentials)) {
            if(\Auth::user()->estado=="1"){
                $user = [
                    'idSucursal'           =>  $request->idSucursal,
                ];
                DB::table('users')->where('id', \Auth::user()->id)->update($user);
                $mytime= Carbon::now('America/Lima');
                
                $inicio= new Inicio();
                $inicio->idUsuario = \Auth::user()->id;
                $inicio->idSucursal = $request->idSucursal;
                $inicio->tipo = "INGRESO";
                $inicio->fecha = $mytime->toDateTimeString();
                $inicio->save();
                
                return redirect()->intended('graphics');
            }
            
            
        }

        

         return back()->withErrors(['usuario' => trans('auth.failed')])
         ->withInput(request(['usuario']));
     }
     

    

    public function logout(Request $request){

        $mytime= Carbon::now('America/Lima');
            
        $inicio= new Inicio();
        $inicio->idUsuario = \Auth::user()->id;
        $inicio->idSucursal = \Auth::user()->idSucursal;
        $inicio->tipo = "SALIDA";
        $inicio->fecha = $mytime->toDateTimeString();
        $inicio->save();

        Auth::logout();

        $request->session()->invalidate();
        return redirect('/');
    }
}
