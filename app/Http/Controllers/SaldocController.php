<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Saldoc;
use App\Models\Compra;

class SaldocController extends Controller
{
    public function index(Request $request)
    {
        $compras=Compra::where('estado','=','Registrado')->get();
        $saldoc=DB::table('saldocs as s')
        ->join('compras as c','s.idCompra','=','c.id')
        ->select('s.id','c.id as idCompra','s.monto','s.fecha')
        ->where('s.estado','=','Pendiente')
        ->get();
        $saldocs = $saldoc->unique('idCompra');
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $medios=DB::table('medios')
        ->orderBy('medios.id','desc')
        ->get();
        return view('saldoc.index',["compras"=>$compras,"usuario"=>$usuario,"medios"=>$medios,"saldocs"=>$saldocs,]);
    }

    public function store(Request $request){
        
        if($request->id_compra_r){
            $mytime= Carbon::now('America/Lima');
            $saldo= Saldoc::findOrFail($request->id_compra_r);
            $saldo->fecha = $mytime->toDateTimeString();
            $saldo->monto=$request->monto;
            $saldo->idMedios=$request->idMedios;
            $saldo->estado="Pagado";
            $saldo->save();
            
    
            $compras = DB::table('compras')
            ->where('compras.id','=',$saldo->idCompra)->get();
                foreach($compras as $com){
                    if($com->saldo==$request->monto){
                        $compra = [
                            'estado'  =>  'Pagado',
                            'acuenta'  =>  $com->acuenta + $request->monto,
                            'saldo'  =>  $com->saldo - $request->monto,
                        ];
                    }else{
                        $compra = [
                            'saldo'  =>  $com->saldo - $request->monto,
                            'acuenta'  =>  $com->acuenta + $request->monto,
                        ];
                    }
                    
                DB::table('compras')->where('id',$saldo->idCompra)->update($compra);
            }
        }else{
            $mytime= Carbon::now('America/Lima');
            $saldo= new Saldoc();
            $saldo->idCompra = $request->id_compra;
            $saldo->fecha = $mytime->toDateTimeString();
            $saldo->monto=$request->monto;
            $saldo->idMedios=$request->idMedios;
            $saldo->estado="Pagado";
            $saldo->idUsuario = \Auth::user()->id;
            $saldo->idSucursal = \Auth::user()->idSucursal;
            $saldo->save();
            
    
            $compras = DB::table('compras')
            ->where('compras.id','=',$saldo->idCompra)->get();
                foreach($compras as $com){
                    if($com->saldo==$request->monto){
                        $compra = [
                            'estado'  =>  'Pagado',
                            'acuenta'  =>  $com->acuenta + $request->monto,
                            'saldo'  =>  $com->saldo - $request->monto,
                        ];
                    }else{
                        $compra = [
                            'saldo'  =>  $com->saldo - $request->monto,
                            'acuenta'  =>  $com->acuenta + $request->monto,
                        ];
                    }
                    
                DB::table('compras')->where('id',$saldo->idCompra)->update($compra);
            }
        }
       

        return redirect()->back()->with('success','Categoria Modificado Correctamente!');


    }
}
