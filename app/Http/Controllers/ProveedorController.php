<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;  

class ProveedorController extends Controller
{
    //
    public function index(Request $request)
    {
        $proveedors=DB::table('proveedors as p')
        ->orderBy('p.id','desc')
        ->get();

        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $categorias=DB::table('categorias')
        ->orderBy('categorias.id','desc')
        ->get();
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('proveedor.index',["proveedors"=>$proveedors,"usuario"=>$usuario,"categorias"=>$categorias,"pacientes"=>$pacientes]);
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'required|unique:proveedors',
            'direccion' => 'nullable',
            'celular' => 'nullable|numeric|digits:9',            
            'email' => 'nullable|email',
            'num_cuenta' => 'nullable',
            'descripcion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $proveedors= new Proveedor();
        $proveedors->nombre = $request->nombre;
        $proveedors->tipo_documento = $request->tipo_documento;
        $proveedors->num_documento = $request->num_documento;
        $proveedors->direccion = $request->direccion;
        $proveedors->celular = $request->celular;
        $proveedors->email = $request->email;
        $proveedors->num_cuenta = $request->num_cuenta;
        $proveedors->descripcion = $request->descripcion;        
        $proveedors->estado = "ACTIVO";
        $proveedors->save();
        return Redirect::to("proveedor"); 
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'required|unique:proveedors',
            'direccion' => 'nullable',
            'celular' => 'nullable|numeric|digits:9',            
            'email' => 'nullable|email',
            'num_cuenta' => 'nullable',
            'descripcion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }
        $proveedors = [
            'nombre'            =>  $request->nombre,       
            'tipo_documento'    =>  $request->tipo_documento,
            'num_documento'     =>  $request->num_documento,
            'direccion'         =>  $request->direccion,
            'celular'           =>  $request->celular,
            'email'             =>  $request->email,
            'num_cuenta'        =>  $request->num_cuenta,
            'descripcion'       =>  $request->descripcion,
            'estado'            =>  $request->estado,

 
        ];
        DB::table('proveedors')->where('id',$request->id_proveedor)->update($proveedors);
        return redirect()->back()->with('success','Proveedor Modificado Correctamente!');
    }


    public function destroy(Request $request)
    {
        //
        $proveedors= Proveedor::findOrFail($request->id_enviar);
         
         if($proveedors->estado=="ACTIVO"){

                $proveedors->estado= 'DESACTIVADO';
                $proveedors->save();
                return redirect()->back()->with('success','Proveedor Eliminado Correctamente!');


           }else{

                $proveedors->estado= 'ACTIVO';
                $proveedors->save();            
                return redirect()->back()->with('success','Proveedor Activado Correctamente!');


            }
    }
}
