<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Carbon\Carbon;  

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $pacientes=DB::table('pacientes')->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();

        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        return view('paciente.index',["pacientes"=>$pacientes,"usuario"=>$usuario]);
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'nullable|unique:pacientes',
            'edad' => 'nullable',
            'celular' => 'nullable|numeric|digits:9',            
            'email' => 'nullable|email',
            'fecha_nac' => 'nullable',
            'tipo' => 'nullable',
            'ocupacion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $pacientes= new Paciente();
        $pacientes->nombre = $request->nombre;
        $pacientes->tipo_documento = $request->tipo_documento;
        $pacientes->num_documento = $request->num_documento;
        $pacientes->edad = $request->edad;
        $pacientes->celular = $request->celular;
        $pacientes->email = $request->email;
        $pacientes->fecha_nac = $request->fecha_nac;
        $pacientes->tipo = $request->tipo;
        $pacientes->ocupacion = $request->ocupacion;
        $pacientes->save();

        return redirect()->back()->with('success','Proveedor Modificado Correctamente!');
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo_documento' => 'required',
            'num_documento' => 'nullable|unique:pacientes',
            'edad' => 'nullable',
            'celular' => 'nullable|numeric|digits:9',            
            'email' => 'nullable|email',
            'tipo' => 'nullable',
            'fecha_nac' => 'nullable',
            'ocupacion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }
        $pacientes = [
            'nombre'            =>  $request->nombre,            
            'tipo_documento'    =>  $request->tipo_documento,
            'num_documento'     =>  $request->num_documento,
            'edad'         =>  $request->edad,
            'celular'           =>  $request->celular,
            'email'             =>  $request->email,
            'tipo'        =>  $request->tipo,
            'fecha_nac'     => $request->fecha_nac,
            'ocupacion'            =>  $request->ocupacion,

 
        ];
        DB::table('pacientes')->where('id',$request->id_paciente2)->update($pacientes);
        return redirect()->back()->with('success','Proveedor Modificado Correctamente!');
    }
    public function delete($id)
    {
        DB::table('pacientes')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }
}
