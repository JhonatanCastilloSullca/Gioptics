<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Redirect;
use DB;

class SucursalController extends Controller
{
    public function index(Request $request)
    {
        $sucursales=DB::table('sucursals')
        ->orderBy('sucursals.id','desc')
        ->get();

        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('sucursal.index',["sucursales"=>$sucursales,"usuario"=>$usuario,"pacientes"=>$pacientes]);
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'direccion' => 'nullable',
            'telefono' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $sucursales= new Sucursal();
        $sucursales->nombre = $request->nombre;
        $sucursales->direccion = $request->direccion;
        $sucursales->telefono = $request->telefono;
        $sucursales->estado = "1";
        $sucursales->save();
        return Redirect::to("sucursal"); 
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'direccion' => 'nullable',
            'telefono' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $sucursales = [
            'nombre'           =>  $request->nombre,
            'direccion'            =>  $request->direccion,            
            'telefono'            =>  $request->telefono,    
        ];
        DB::table('sucursals')->where('id',$request->id_sucursal2)->update($sucursales);
        return redirect()->back()->with('success','Categoria Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $sucursales= Sucursal::findOrFail($request->id_enviar);
         if($sucursales->estado=="Activo"){
            $sucursales->estado= 'Desactivo';
            $sucursales->save();
            return redirect()->back()->with('success','Categoria Eliminado Correctamente!');
        }else{
            $sucursales->estado= 'Activo';
            $sucursales->save();            
            return redirect()->back()->with('success','Categoria Activado Correctamente!');
        }
    }

    public function delete($id)
    {
        DB::table('sucursals')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }
}
