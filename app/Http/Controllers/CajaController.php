<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;  

use DB;

class CajaController extends Controller
{
    //
    public function index(Request $request)
    {
        $mytime= Carbon::now('America/Lima');

        $sql2=$mytime->toDateString();
        
        $ingresos= DB::table('cajas as c')
        ->where('c.fecha','=',$sql2)
        ->where('c.tipo','=',"Ingreso")
        ->where('c.estado','!=',"Anulado")
        ->where('c.idSucursal','=',\Auth::user()->idSucursal)
        ->sum('c.monto');
        $egresos= DB::table('cajas as c')
        ->where('c.fecha','=',$sql2)
        ->where('c.tipo','=',"Egreso")
        ->where('c.estado','!=',"Anulado")
        ->where('c.idSucursal','=',\Auth::user()->idSucursal)
        ->sum('c.monto');


        $cajas=DB::table('cajas as c')->join('users as u','c.idUsuario','=','u.id')
        ->join('medios as m','c.idMedios','=','m.id')->join('sucursals as s','c.idSucursal','=','s.id')
        ->select('c.id','c.descripcion','c.fecha','c.monto','c.tipo','u.nombre as usuario','m.nombre as medio','m.banco',
        's.nombre as sucursal','c.estado','c.documento','c.numero')
        ->where('c.fecha','=',$sql2)
        ->where('c.estado','!=',"Anulado")
        ->where('c.idSucursal','=',\Auth::user()->idSucursal)
        ->orderBy('c.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $medios=DB::table('medios')
        ->orderBy('medios.id','desc')
        ->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();

        return view('caja.index',["cajas"=>$cajas,"ingresos"=>$ingresos,"egresos"=>$egresos,"usuario"=>$usuario,"medios"=>$medios,"pacientes"=>$pacientes
        ]);
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'descripcion' => 'required',
            'monto' => 'required|numeric',
            'documento' => 'nullable',
            'numero' => 'nullable',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }
        $mytime= Carbon::now('America/Lima');


        $cajas= new Caja();
        $cajas->descripcion =   $request->descripcion;
        $cajas->documento =   $request->documento;
        $cajas->numero =    $request->numero;
        $cajas->fecha =         $mytime->toDateTimeString();
        $cajas->monto =         $request->monto;
        $cajas->tipo =          $request->tipo;
        $cajas->idUsuario =     \Auth::user()->id;
        $cajas->idSucursal =     \Auth::user()->idSucursal;
        $cajas->idMedios =      $request->idMedios;        
        $cajas->estado = "1";
        $cajas->save();

        return Redirect::to("caja"); 
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'monto' => 'required',
            'tipo' => 'required',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $cajas = [
            
            'descripcion' =>  $request->descripcion,
            'fecha' =>  $request->fecha,
            'monto' =>  $request->monto,
            'tipo'  =>  $request->tipo,
            'idUsuario'  =>  $request->idUsuario,
            'idMedios' =>  $request->idMedios,
            'estado' =>  $request->estado,
 
        ];
        DB::table('cajas')->where('id',$request->id_caja)->update($cajas);
        return redirect()->back()->with('success','Caja Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $cajas= Caja::findOrFail($request->id_caja);
         if($cajas->estado=="1"){
            $cajas->estado= '0';
            $cajas->save();
            return redirect()->back()->with('success','Caja Eliminado Correctamente!');
        }else{
            $cajas->estado= '1';
            $cajas->save();            
            return redirect()->back()->with('success','Caja Activado Correctamente!');
        }
    }

    public function cajadiaria()
    {
        $mytime= Carbon::now('America/Lima');

        $sql2=$mytime->toDateString();
        
        $ingresos= DB::table('cajas as c')
        ->where('c.fecha','=',$sql2)
        ->where('c.tipo','=',"Ingreso")
        ->where('c.estado','!=',"Anulado")
        ->where('c.idSucursal','=',\Auth::user()->idSucursal)
        ->sum('c.monto');
        $egresos= DB::table('cajas as c')
        ->where('c.fecha','=',$sql2)
        ->where('c.tipo','=',"Egreso")
        ->where('c.estado','!=',"Anulado")
        ->where('c.idSucursal','=',\Auth::user()->idSucursal)
        ->sum('c.monto');


        $cajas=DB::table('cajas as c')->join('users as u','c.idUsuario','=','u.id')
        ->join('medios as m','c.idMedios','=','m.id')->join('sucursals as s','c.idSucursal','=','s.id')
        ->select('c.id','c.descripcion','c.fecha','c.monto','c.tipo','u.nombre as usuario','m.nombre as medio','m.banco',
        's.nombre as sucursal','c.estado','c.documento','c.numero')
        ->where('c.fecha','=',$sql2)
        ->where('c.estado','!=',"Anulado")
        ->where('c.idSucursal','=',\Auth::user()->idSucursal)
        ->orderBy('c.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $medios=DB::table('medios')
        ->orderBy('medios.id','desc')
        ->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();


        
        $pdf= \PDF::loadView('pdf.cajadiariapdf',["cajas"=>$cajas,"ingresos"=>$ingresos,"egresos"=>$egresos,"usuario"=>$usuario,"medios"=>$medios,"sql2"=>$sql2])->setPaper('a4');
        return $pdf->download('Caja.pdf');
    }

}
