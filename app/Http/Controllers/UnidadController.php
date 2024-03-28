<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Unidad;
use Illuminate\Support\Facades\Redirect;
use DB;
class UnidadController extends Controller
{    
    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',            
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();
        }

        $unidads= new Unidad();
        $unidads->nombre = $request->nombre;
        $unidads->estado = "1";
        $unidads->save();        
        return redirect()->back()->with('success','Categoria Modificado Correctamente!');
    }
    public function index(Request $request)
    {
        $unidads=Unidad::all();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        return view('unidad.index',["unidads"=>$unidads,"usuario"=>$usuario]);        
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
        $unidads = [
            'nombre'           =>  $request->nombre 
        ];
        DB::table('unidads')->where('id',$request->id_unidad2)->update($unidads);
        return redirect()->back()->with('success','Unidad Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $unidads= Unidad::findOrFail($request->id_unidad3);
         if($unidads->estado=="1"){
            $unidads->estado= '0';
            $unidads->save();
            return redirect()->back()->with('success','Unidad Eliminado Correctamente!');
        }else{
            $unidads->estado= '1';
            $unidads->save();            
            return redirect()->back()->with('success','Unidad Activado Correctamente!');
        }
    }

    public function delete($id)
    {
        DB::table('unidads')->where('id',$id)->delete();
        return redirect()->back()->with('success','Tours Eliminado Correctamente!');
    }

    

}
