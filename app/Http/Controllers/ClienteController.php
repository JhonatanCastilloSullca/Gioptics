<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;  

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes=DB::table('clientes')->where('clientes.id','>',0)  
        ->orderBy('clientes.id','desc')
        ->get();

        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('cliente.index',["clientes"=>$clientes,"usuario"=>$usuario,"pacientes"=>$pacientes]);
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'required|unique:clientes',
            'celular' => 'required|numeric|digits:9',            
            'email' => 'nullable|email',
            'fecha_nac' => 'nullable',
            'tipo' => 'nullable',
            'direccion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $clientes= new Cliente();
        $clientes->nombre = $request->nombre;
        $clientes->tipo_documento = $request->tipo_documento;
        $clientes->num_documento = $request->num_documento;
        $clientes->celular = $request->celular;
        $clientes->email = $request->email;
        $clientes->tipo = $request->tipo;
        $clientes->fecha_nac = $request->fecha_nac;
        $clientes->direccion = $request->direccion;
        $clientes->save();

        return redirect()->back()->with('success','Proveedor Modificado Correctamente!')->withInput($request->all());;
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'required',
            'celular' => 'required|numeric|digits:9',            
            'email' => 'nullable|email',
            'fecha_nac' => 'nullable',
            'tipo' => 'nullable',
            'direccion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }
        $clientes = [
            'nombre'            =>  $request->nombre,            
            'tipo_documento'    =>  $request->tipo_documento,
            'num_documento'     =>  $request->num_documento,
            'celular'           =>  $request->celular,
            'email'             =>  $request->email,
            'fecha_nac'         =>  $request->fecha_nac,
            'direccion'         =>  $request->direccion,

 
        ];
        DB::table('clientes')->where('id',$request->id_cliente2)->update($clientes);
        return redirect()->back()->with('success','Proveedor Modificado Correctamente!');
    }
    public function delete($id)
    {
        DB::table('clientes')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }
}
