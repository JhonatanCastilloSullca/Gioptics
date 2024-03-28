<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $usuarios=DB::table('users')
        ->where('users.rol','!=','Agencia')
        ->orderBy('users.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('user.index',["usuarios"=>$usuarios,"usuario"=>$usuario,"pacientes"=>$pacientes]);
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'required|unique:users',
            'celular' => 'nullable|numeric|digits:9',            
            'email' => 'nullable|email',
            'usuario' => 'required|unique:users',
            'password' => 'required',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $user= new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->tipo_documento = $request->tipo_documento;
        $user->num_documento = $request->num_documento;
        $user->celular = $request->celular;
        $user->email = $request->email;
        $user->rol = $request->rol;
        $user->usuario = $request->usuario;
        $user->password = bcrypt( $request->password);
        $user->idSucursal = 1;
        $user->estado = "1";
        $user->save();
        return Redirect::to("user"); 
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'nullable',
            'celular' => 'nullable|numeric|digits:9',            
            'email' => 'nullable|email',
            'usuario' => 'required',
            'password' => 'required',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $user = [
            'nombre'           =>  $request->nombre,
            'apellido'            =>  $request->apellido,
            'tipo_documento'  =>  $request->tipo_documento,
            'num_documento'  =>  $request->num_documento,
            'celular'          =>  $request->celular,
            'email'  =>  $request->email,
            'rol'          =>  $request->rol,
            'usuario'   =>  $request->usuario,
            'password'         =>bcrypt($request->password)
 
        ];
        DB::table('users')->where('id',$request->id_usuario2)->update($user);
        return redirect()->back()->with('success','Usuario Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $users= User::findOrFail($request->id_user);
         if($users->estado=="1"){
            $users->estado= '0';
            $users->save();
            return redirect()->back()->with('success','Usuario Eliminado Correctamente!');
        }else{
            $users->estado= '1';
            $users->save();            
            return redirect()->back()->with('success','Proveedor Activado Correctamente!');
        }
    }

    public function prueba()
    {
        return User::all();
    }

    public function delete($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }

}
