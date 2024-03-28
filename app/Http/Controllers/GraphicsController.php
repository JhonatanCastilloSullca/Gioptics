<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon; 

class GraphicsController extends Controller
{
    //
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\Auth::user()->rol=="Gerencia"){
            $mytime= Carbon::now('America/Lima');
            $sql2=$mytime->toDateString();
            $sql3=date("Y-m-d",strtotime($sql2."- 7 days"));
            $fechas=[];
            $fechas[1]=$sql2;
            $fechas[2]=date("Y-m-d",strtotime($sql2."- 1 days"));
            $fechas[3]=date("Y-m-d",strtotime($sql2."- 2 days"));
            $fechas[4]=date("Y-m-d",strtotime($sql2."- 3 days"));
            $fechas[5]=date("Y-m-d",strtotime($sql2."- 4 days"));
            $fechas[6]=date("Y-m-d",strtotime($sql2."- 5 days"));
            $fechas[7]=date("Y-m-d",strtotime($sql2."- 6 days"));
            $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
            ->where('u.id','=',\Auth::user()->id)
            ->select('u.id','u.nombre','s.nombre as sucursal')
            ->get();
            $pacientes=DB::table('pacientes')
            ->where('pacientes.id','>',1)  
            ->orderBy('pacientes.id','desc')
            ->get();
            $clientesatendidos= DB::table('ventas as v')
            ->select(DB::raw('count(*) as clientes'))
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->get();
            $cantidadproductos= DB::table('detalle_ventas as dv')->join('ventas as v','dv.idVenta','=','v.id')
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->sum('dv.cantidad');
            
            $ventassemanales= DB::table('detalle_ventas as dv')->join('ventas as v','dv.idVenta','=','v.id')->join('users as u','v.idUsuario','=','u.id')
            ->select(DB::raw('SUM(dv.cantidad*dv.precio) as total'),'u.nombre')
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->groupBy('u.nombre')
            ->get();

            $productossemanales= DB::table('detalle_ventas as dv')->join('ventas as v','dv.idVenta','=','v.id')->join('productos as p','dv.idProducto','=','p.id')
            ->select(DB::raw('SUM(dv.cantidad) as total'),'p.nombre')
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->groupBy('p.nombre')
            ->get();

            $productossemanales= DB::table('detalle_ventas as dv')->join('ventas as v','dv.idVenta','=','v.id')->join('productos as p','dv.idProducto','=','p.id')->join('categorias as c','p.categoria_id','=','p.id')
            ->select(DB::raw('SUM(dv.cantidad) as total'),'c.nombre')
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->groupBy('c.nombre')
            ->get();

            $medicionsemanales= DB::table('medidas as m')->join('users as u','m.idUsuario','=','u.id')
            ->select(DB::raw('count(*) as medicion'),'u.nombre')
            ->where('m.fecha','>=',$sql3)
            ->where('m.fecha','<=',$sql2)
            ->groupBy('u.nombre')
            ->get();

            $ingresos= DB::table('cajas as c')
            ->where('c.fecha','=',$sql2)
            ->where('c.tipo','=',"Ingreso")
            ->where('c.estado','!=',"Anulado")
            ->sum('c.monto');

            $ingresos= DB::table('cajas as c')
            ->where('c.fecha','=',$sql2)
            ->where('c.tipo','=',"Ingreso")
            ->where('c.estado','!=',"Anulado")
            ->sum('c.monto');
            $egresos= DB::table('cajas as c')
            ->where('c.fecha','=',$sql2)
            ->where('c.tipo','=',"Egreso")
            ->where('c.estado','!=',"Anulado")
            ->sum('c.monto');

            $ingresossemanales= DB::table('cajas as c')
            ->select(DB::raw('SUM(c.monto) as total'),'c.fecha')
            ->where('c.fecha','>=',$sql3)
            ->where('c.fecha','<=',$sql2)
            ->where('c.tipo','=',"Ingreso")
            ->where('c.estado','!=',"Anulado")
            ->groupBy('c.fecha')
            ->get();
            $egresossemanales= DB::table('cajas as c')
            ->select(DB::raw('SUM(c.monto) as total'),'c.fecha')
            ->where('c.fecha','>=',$sql3)
            ->where('c.fecha','<=',$sql2)
            ->where('c.tipo','=',"Egreso")
            ->where('c.estado','!=',"Anulado")
            ->groupBy('c.fecha')
            ->get();

            $ventassucursales= DB::table('ventas as v')->join('detalle_ventas as dv','dv.idVenta','=','v.id')->join('sucursals as s','v.idSucursal','=','s.id')
            ->select(DB::raw('SUM(dv.cantidad*dv.precio) as total'),'s.nombre')
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->groupBy('s.nombre')
            ->get();

            $categoriassemanales= DB::table('detalle_ventas as dv')->join('ventas as v','dv.idVenta','=','v.id')->join('productos as p','dv.idProducto','=','p.id')
            ->join('categorias as c','p.categoria_id','=','c.id')
            ->select(DB::raw('SUM(dv.cantidad) as total'),'c.nombre')
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->groupBy('c.nombre')
            ->get();

            return view('graphics',compact('usuario','pacientes','clientesatendidos','cantidadproductos','ventassemanales','ingresos','egresos','productossemanales','medicionsemanales','egresossemanales','ingresossemanales','fechas','ventassucursales','categoriassemanales'));

        }else{
            $mytime= Carbon::now('America/Lima');
            $sql2=$mytime->toDateString();
            $sql3=date("Y-m-d",strtotime($sql2."- 7 days"));
            $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
            ->where('u.id','=',\Auth::user()->id)
            ->select('u.id','u.nombre','s.nombre as sucursal')
            ->get();
            $pacientes=DB::table('pacientes')
            ->where('pacientes.id','>',1)  
            ->orderBy('pacientes.id','desc')
            ->get();
            $clientesatendidos= DB::table('ventas as v')
            ->select(DB::raw('count(*) as clientes'))
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->where('v.idSucursal','=',\Auth::user()->idSucursal)
            ->get();
            $cantidadproductos= DB::table('detalle_ventas as dv')->join('ventas as v','dv.idVenta','=','v.id')
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->where('v.idSucursal','=',\Auth::user()->idSucursal)
            ->sum('dv.cantidad');
            
            $ventassemanales= DB::table('detalle_ventas as dv')->join('ventas as v','dv.idVenta','=','v.id')
            ->select(DB::raw('SUM(dv.cantidad*dv.precio) as total'),'v.fecha')
            ->where('v.fecha','>=',$sql3)
            ->where('v.fecha','<=',$sql2)
            ->where('v.idUsuario','=',\Auth::user()->id)
            ->where('v.idUsuario','=',\Auth::user()->id)
            ->groupBy('v.fecha')
            ->get();
            $medicionsemanales= DB::table('medidas as m')->join('users as u','m.idUsuario','=','u.id')
            ->select(DB::raw('count(*) as medicion'),'u.nombre')
            ->where('m.fecha','>=',$sql3)
            ->where('m.fecha','<=',$sql2)
            ->groupBy('u.nombre')
            ->get();
    
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
    
            return view('graphicsespecialista',compact('usuario','pacientes','clientesatendidos','cantidadproductos','ventassemanales','ingresos','egresos','medicionsemanales'));
        }
        
    }
}
