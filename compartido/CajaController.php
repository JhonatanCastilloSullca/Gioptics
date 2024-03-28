<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\CajaExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class CajaController extends Controller
{
    public function index(Request $request)
    {
        $mytime= Carbon::now('America/Lima');

        $sql2=trim($request->buscarFecha);
        $sql7=$mytime->toDateString();
        $sql8=date("Y-m-d",strtotime($sql7."- 1 days"));
        $sql4=$mytime->toDateString();
        
        if($sql2=='')
        {
            $sql2=$mytime->toDateString();
        }else{
            $sql2=trim($request->buscarFecha);
        }
        $ingresos= DB::table('ingresos as i')
        ->where('i.fecha','=',$sql2)
        ->sum('i.monto');
        $egresos= DB::table('egresos as e')
            ->where('e.fecha','=',$sql2)
            ->sum('e.monto');
        $ingresosanterior= DB::table('ingresos as i')
            ->where('i.fecha','<',$sql2)
            ->sum('i.monto');
        $egresosanterior= DB::table('egresos as e')
            ->where('e.fecha','<',$sql2)
            ->sum('e.monto');
        $totalanterior=$ingresosanterior - $egresosanterior;

        $ingresosdolares= DB::table('ingresos as i')
        ->where('i.fecha','=',$sql2)
        ->sum('i.montodolares');
        $egresosdolares= DB::table('egresos as e')
            ->where('e.fecha','=',$sql2)
            ->sum('e.requerida');
        $ingresosdolaresanterior= DB::table('ingresos as i')
            ->where('i.fecha','<',$sql2)
            ->sum('i.montodolares');
        $egresosdolaresanterior= DB::table('egresos as e')
            ->where('e.fecha','<',$sql2)
            ->sum('e.requerida');

        $totalanteriordolares=$ingresosdolaresanterior - $egresosdolaresanterior;

        $ingresosdetalle=DB::table('ingresos as i')->join('users as u','i.idUsuario','=','u.id')
        ->join('tipos as t','i.idTipo','=','t.id')->join('proveedors as p','i.idProveedor','=','p.id')
        ->select('i.id','i.fecha','i.idTipo','p.nombre as responsable','i.montodolares',
        'i.monto','i.descripcion','i.sustento','i.numerosustento','t.nombre as tipo','i.proveniente','u.nombre as usuario')
        ->where('i.fecha','=',$sql2)
        ->orderBy('i.fecha')->get();

        $egresosdetalle=DB::table('egresos as e')->join('categorias as c','e.idCategoria','=','c.id')->join('users as u','e.idUsuario','=','u.id')
        ->join('contratos as con','e.idContrato','=','con.id')->join('tipos as t','e.idTipo','=','t.id')->join('proveedors as pr','e.idProveedor','=','pr.id')
        ->select('e.id','e.fecha','c.nombre as categoria','con.nombre as proyecto','t.nombre as tipo','e.idTipo','e.insumo','pr.nombre as proveedor',
        'e.detalle','e.cantidad','e.requerida','e.descripcion','e.monto','e.medioPago','e.numero','e.sustento','e.numerosustento','u.nombre as usuario')
        ->where('e.fecha','=',$sql2)
        ->orderBy('e.fecha')->get();

        $productos=DB::table('productos')->get();
        $cuentas=DB::table('tipopagos')->get();
        $categorias=DB::table('categorias')->get();
        $tipos=DB::table('tipos')->get();
        $insumos=DB::table('insumos')->get();
        $prestamos=DB::table('prestamos')->get();
        $maquinarias=DB::table('maquinarias')->get();
        $requerimientos=DB::table('requerimientos as r')->join('users as u','r.idUsuario','=','u.id')->select('r.id','u.nombre as usuario','r.numero')->get();
        $sql4=$sql2;
        return view('caja.index',["buscarFecha"=>$sql2,"ingresosdolares"=>$ingresosdolares,"egresosdolares"=>$egresosdolares,"totalanteriordolares"=>$totalanteriordolares,
        "ingresos"=>$ingresos,"egresos"=>$egresos,"totalanterior"=>$totalanterior,"egresosdetalle"=>$egresosdetalle
        ,"ingresosdetalle"=>$ingresosdetalle,"sql4"=>$sql4,"sql7"=>$sql7
        ,"productos"=>$productos,"cuentas"=>$cuentas,"categorias"=>$categorias,"tipos"=>$tipos,"insumos"=>$insumos,"prestamos"=>$prestamos,"maquinarias"=>$maquinarias,"requerimientos"=>$requerimientos]);
            
    }

    public function listarCajaPdf($id){

        $mytime= Carbon::now('America/Lima');
        $sql2=$id;

        $ingresos= DB::table('ingresos as i')
        ->where('i.fecha','=',$sql2)
        ->sum('i.monto');
        $egresos= DB::table('egresos as e')
            ->where('e.fecha','=',$sql2)
            ->sum('e.monto');
        $ingresosanterior= DB::table('ingresos as i')
            ->where('i.fecha','<',$sql2)
            ->sum('i.monto');
        $egresosanterior= DB::table('egresos as e')
            ->where('e.fecha','<',$sql2)
            ->sum('e.monto');
        $totalanterior=$ingresosanterior - $egresosanterior;

        $ingresosdolares= DB::table('ingresos as i')
        ->where('i.fecha','=',$sql2)
        ->sum('i.montodolares');
        $egresosdolares= DB::table('egresos as e')
            ->where('e.fecha','=',$sql2)
            ->sum('e.requerida');
        $ingresosdolaresanterior= DB::table('ingresos as i')
            ->where('i.fecha','<',$sql2)
            ->sum('i.montodolares');
        $egresosdolaresanterior= DB::table('egresos as e')
            ->where('e.fecha','<',$sql2)
            ->sum('e.requerida');

        $totalanteriordolares=$ingresosdolaresanterior - $egresosdolaresanterior;

        $ingresosdetalle=DB::table('ingresos as i')->join('users as u','i.idUsuario','=','u.id')
        ->join('tipos as t','i.idTipo','=','t.id')->join('proveedors as p','i.idProveedor','=','p.id')
        ->select('i.id','i.fecha','i.idTipo','p.nombre as responsable','i.montodolares',
        'i.monto','i.descripcion','i.sustento','i.numerosustento','t.nombre as tipo','i.proveniente','u.nombre as usuario')
        ->where('i.fecha','=',$sql2)
        ->orderBy('i.fecha')->get();

        $egresosdetalle=DB::table('egresos as e')->join('categorias as c','e.idCategoria','=','c.id')->join('users as u','e.idUsuario','=','u.id')
        ->join('contratos as con','e.idContrato','=','con.id')->join('tipos as t','e.idTipo','=','t.id')->join('proveedors as pr','e.idProveedor','=','pr.id')
        ->select('e.id','e.fecha','c.nombre as categoria','con.nombre as proyecto','t.nombre as tipo','e.idTipo','e.insumo','pr.nombre as proveedor',
        'e.detalle','e.cantidad','e.requerida','e.descripcion','e.monto','e.medioPago','e.numero','e.sustento','e.numerosustento','u.nombre as usuario')
        ->where('e.fecha','=',$sql2)
        ->orderBy('e.fecha')->get();

        $productos=DB::table('productos')->get();
        $cuentas=DB::table('tipopagos')->get();
        $categorias=DB::table('categorias')->get();
        $tipos=DB::table('tipos')->get();
        $insumos=DB::table('insumos')->get();
        $prestamos=DB::table('prestamos')->get();
        $maquinarias=DB::table('maquinarias')->get();
        $sql4=$sql2;
        
          
        $pdf= \PDF::loadView('pdf.cajadiariapdf',[
            "sql2"=>$sql2,"ingresosdolares"=>$ingresosdolares,"egresosdolares"=>$egresosdolares,"totalanteriordolares"=>$totalanteriordolares,
        "ingresos"=>$ingresos,"egresos"=>$egresos,"totalanterior"=>$totalanterior,"egresosdetalle"=>$egresosdetalle
        ,"ingresosdetalle"=>$ingresosdetalle,"sql4"=>$sql4
        ,"productos"=>$productos,"cuentas"=>$cuentas,"categorias"=>$categorias,"tipos"=>$tipos,"insumos"=>$insumos,"prestamos"=>$prestamos,"maquinarias"=>$maquinarias])->setPaper('a4','landscape');
        return $pdf->download('reportecajadiario'.$id.'.pdf');
    }

    public function export(Request $request,$sql4)
    {
        return Excel::download(new CajaExport($sql4), 'cajadiario.xlsx');
    }
}
