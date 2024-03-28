<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medio;
use Illuminate\Support\Facades\Redirect;
use DB;

class MedioController extends Controller
{
    public function index(Request $request)
    {
        $medios=DB::table('medios')
        ->orderBy('medios.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('medio.index',["medios"=>$medios,"usuario"=>$usuario,"pacientes"=>$pacientes]);
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'banco' => 'nullable',
            'numero' => 'nullable',
            'moneda' => 'nullable',
            'descripcion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $medios= new Medio();
        $medios->nombre = $request->nombre;
        $medios->banco = $request->banco;
        $medios->numero = $request->numero;
        $medios->moneda = $request->moneda;
        $medios->descripcion = $request->descripcion;
        $medios->estado = "1";
        $medios->save();
        return Redirect::to("medio"); 
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'banco' => 'nullable',
            'numero' => 'nullable',
            'moneda' => 'nullable',
            'descripcion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $medios = [
            'nombre'           =>  $request->nombre,
            'banco'            =>  $request->banco,            
            'numero'            =>  $request->numero,
            'moneda'            =>  $request->moneda,            
            'descripcion'            =>  $request->descripcion,      
        ];
        DB::table('medios')->where('id',$request->id_medio2)->update($medios);
        return redirect()->back()->with('success','Categoria Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $medios= Medio::findOrFail($request->id_enviar);
         if($medios->estado=="1"){
            $medios->estado= '0';
            $medios->save();
            return redirect()->back()->with('success','Categoria Eliminado Correctamente!');
        }else{
            $medios->estado= '1';
            $medios->save();            
            return redirect()->back()->with('success','Categoria Activado Correctamente!');
        }
    }

    public function delete($id)
    {
        DB::table('medios')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }
}
