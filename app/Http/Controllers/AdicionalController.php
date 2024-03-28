<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adicional;
use App\Models\AdicionalCategoria;
use Illuminate\Support\Facades\Redirect;
use DB;

class AdicionalController extends Controller
{
    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 7)->withErrors($requ->errors())->withInput();

        }
        $adicionales= new Adicional();
        $adicionales->nombre = $request->nombre; 
        $adicionales->estado = "1";
        $adicionales->save();
        $adicional= new AdicionalCategoria();
        $adicional->adicional_id = $adicionales->id; 
        $adicional->categoria_id = $request->id_categoria;
        $adicional->save();
        return redirect()->back()->with('success','Categoria Modificado Correctamente!');        
    }

    
    public function index(Request $request)
    {
        $adicionals=Adicional::all();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        return view('adicional.index',["adicionals"=>$adicionals,"usuario"=>$usuario]);        
    }
    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required'
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();
        }
        $adicionals = [
            'nombre'           =>  $request->nombre 
        ];
        DB::table('adicionals')->where('id',$request->id_adicional2)->update($adicionals);
        return redirect()->back()->with('success','Adicional Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $adicionals= Adicional::findOrFail($request->id_adicional3);
         if($adicionals->estado=="1"){
            $adicionals->estado= '0';
            $adicionals->save();
            return redirect()->back()->with('success','Adicional Eliminado Correctamente!');
        }else{
            $adicionals->estado= '1';
            $adicionals->save();            
            return redirect()->back()->with('success','Adicional Activado Correctamente!');
        }
    }


    public function delete($id)
    {
        DB::table('adicional_categoria')->where('adicional_id',$id)->delete();
        DB::table('adicionals')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }
}
