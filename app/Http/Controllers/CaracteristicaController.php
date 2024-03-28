<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\Redirect;
use DB;

class CaracteristicaController extends Controller
{
    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'adicional_id' => 'required',
        ]);
        if ($requ->fails())
        {
            return redirect()->back()->with('error_code', 8)->withErrors($requ->errors())->withInput();

        }

        $caracteristica= new Caracteristica();
        $caracteristica->nombre = $request->nombre; 
        $caracteristica->estado = "1";
        $caracteristica->adicional_id = $request->adicional_id;
        $caracteristica->save();

        return redirect()->back()->with('success','Categoria Modificado Correctamente!');        
    }
    
    public function index(Request $request)
    {
        $caracteristicas=Caracteristica::all();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        return view('caracteristica.index',["caracteristicas"=>$caracteristicas,"usuario"=>$usuario]);        
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
        $caracteristicas = [
            'nombre'           =>  $request->nombre 
        ];
        DB::table('caracteristicas')->where('id',$request->id_caracteristica2)->update($caracteristicas);
        return redirect()->back()->with('success','Caracteristica Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $caracteristicas= Caracteristica::findOrFail($request->id_caracteristica3);
         if($caracteristicas->estado=="1"){
            $caracteristicas->estado= '0';
            $caracteristicas->save();
            return redirect()->back()->with('success','Caracteristica Eliminado Correctamente!');
        }else{
            $caracteristicas->estado= '1';
            $caracteristicas->save();            
            return redirect()->back()->with('success','Caracteristica Activado Correctamente!');
        }
    }

    public function delete($id)
    {
        DB::table('caracteristicas')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }

}
