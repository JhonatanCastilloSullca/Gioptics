<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Redirect;
use DB;

class CategoriaController extends Controller
{
    //
    public function index(Request $request)
    {
        $productos=DB::table('productos as p')
        ->orderBy('p.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        $categorias=Categoria::all();

        return view('categoria.index',["productos"=>$productos,"usuario"=>$usuario,"pacientes"=>$pacientes,"categorias"=>$categorias]);
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo' => 'nullable',
            'descripcion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $categorias= new Categoria();
        $categorias->nombre = $request->nombre;
        $categorias->tipo = $request->tipo;
        $categorias->descripcion = $request->descripcion;
        $categorias->estado = "1";
        $categorias->save();
        return redirect()->back()->with('success','Categoria Modificado Correctamente!');
        
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'tipo' => 'required',
            'descripcion' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $categorias = [
            'nombre'           =>  $request->nombre,
            'tipo'              =>  $request->tipo,
            'descripcion'            =>  $request->descripcion,            
 
        ];
        DB::table('categorias')->where('id',$request->id_categoria2)->update($categorias);
        return redirect()->back()->with('success','Categoria Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $categorias= Categoria::findOrFail($request->id_categoria3);
         if($categorias->estado=="1"){
            $categorias->estado= '0';
            $categorias->save();
            return redirect()->back()->with('success','Categoria Eliminado Correctamente!');
        }else{
            $categorias->estado= '1';
            $categorias->save();            
            return redirect()->back()->with('success','Categoria Activado Correctamente!');
        }
    }

    public function prueba()
    {
        return Categoria::where('estado','=','1')->get();
    }

    public function categoriacrud(Request $request)
    {
        $categorias=Categoria::all();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        return view('categoria.categoriacrud',["categorias"=>$categorias,"usuario"=>$usuario]);        
    }

    public function delete($id)
    {
        DB::table('categorias')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }

}
