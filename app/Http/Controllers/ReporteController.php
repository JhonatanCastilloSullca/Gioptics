<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Exports\IngresoExports;
use App\Exports\ComprasExports;
use App\Exports\VentasExports;
use App\Exports\HistoriaExports;
use App\Exports\CajasExports;
use App\Exports\ProductosExports;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Venta;
use App\Models\Sucursal;

class ReporteController extends Controller
{
    public function ingreso(Request $request)
    {
        $mytime= Carbon::now('America/Lima');
        if($request->buscarFechaInicio==""){
            $sql2 = $mytime->toDateString();
        }else{
            $sql2 = $request->buscarFechaInicio;
        }
        if($request->buscarFechaFin==""){
            $sql2 = $mytime->toDateString();
            $sql3=$mytime->toDateString();
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }else{
            $sql3=trim($request->buscarFechaFin);
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }
        if($request->buscarUsuario==0){
            $sql5 = "%%";
        }else{
            $sql5 = $request->buscarUsuario;
        }
        if($request->buscarSucursal==0){
            $sql6 = "%%";
        }else{
            $sql6 = $request->buscarSucursal;
        }

        $ingresos=DB::table('inicios as i')->join('sucursals as s','i.idSucursal','=','s.id')
        ->join('users as u','i.idUsuario','=','u.id')
        ->select('i.id','i.tipo','s.nombre as sucursal','u.nombre as usuario','i.fecha')
        ->where('i.fecha','>=',$sql2)
        ->where('i.fecha','<=',$sql4)
        ->where('i.idUsuario','LIKE',$sql5)
        ->where('i.idSucursal','LIKE',$sql6)
        ->orderBy('i.id','asc')
        ->get();

        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $usuarios=DB::table('users as u')->orderBy('u.nombre','ASC')->get();
        $sucursales=DB::table('sucursals as s')->orderBy('s.nombre','ASC')->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('reporte.ingreso',compact('usuario','usuarios','sucursales','ingresos','sql2','sql3','sql4','sql5','sql6','pacientes'));
    }
    public function ingresopdf(Request $request,$sql2,$sql4,$sql5,$sql6)
    {
        $ingresos=DB::table('inicios as i')->join('sucursals as s','i.idSucursal','=','s.id')
        ->join('users as u','i.idUsuario','=','u.id')
        ->select('i.id','i.tipo','s.nombre as sucursal','u.nombre as usuario','i.fecha')
        ->where('i.fecha','>=',$sql2)
        ->where('i.fecha','<=',$sql4)
        ->where('i.idUsuario','LIKE',$sql5)
        ->where('i.idSucursal','LIKE',$sql6)
        ->orderBy('i.id','asc')
        ->get();

        $usuario=DB::table('users as u')
        ->where('u.id','=',$sql5)
        ->first();

        $sucursal=DB::table('sucursals as s')
        ->where('s.id','=',$sql6)
        ->first();
        
        $pdf= \PDF::loadView('pdf.ingresopdf',["ingresos"=>$ingresos,
        "sql2"=>$sql2,"sql4"=>$sql4,"sql5"=>$sql5,"sql6"=>$sql6,"usuario"=>$usuario,"sucursal"=>$sucursal])->setPaper('a4');
        return $pdf->download('ReporteIngresosSistema.pdf');
    }

    public function ingresoexcel(Request $request,$sql2,$sql4,$sql5,$sql6)
    {
        return Excel::download(new IngresoExports($sql2,$sql4,$sql5,$sql6), 'ingresos.xlsx');
    }

    public function compras(Request $request)
    {
        $mytime= Carbon::now('America/Lima');
        if($request->buscarFechaInicio==""){
            $sql2 = $mytime->toDateString();
        }else{
            $sql2 = $request->buscarFechaInicio;
        }
        if($request->buscarFechaFin==""){
            $sql2 = $mytime->toDateString();
            $sql3=$mytime->toDateString();
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }else{
            $sql3=trim($request->buscarFechaFin);
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }
        if($request->buscarProveedor==0){
            $sql5 = "%%";
        }else{
            $sql5 = $request->buscarProveedor;
        }
        if($request->buscarProducto==0){
            $sql6 = "%%";
        }else{
            $sql6 = $request->buscarProducto;
        }

        $compras=Compra::where('compras.fecha','>=',$sql2)
        ->where('compras.fecha','<=',$sql4)->whereHas('detallecompras.productos', function($query) use ($sql6) {
            $query->where('categoria_id','LIKE', $sql6);
        })->whereHas('detallecompras.productos', function($query) use ($sql5) {
            $query->where('proveedor_id','LIKE',$sql5);
        })->where('compras.estado','=','Registrado')->orderBy('compras.id','asc')->get();

        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $proveedor=DB::table('proveedors as p')->orderBy('p.nombre','ASC')->get();
        $productos=Categoria::orderBy('nombre','ASC')->get();
        return view('reporte.compras',compact('usuario','proveedor','productos','compras','sql2','sql3','sql4','sql5','sql6'));
    }
    public function compraspdf(Request $request,$sql2,$sql4,$sql5,$sql6)
    {
        $compras=Compra::where('compras.fecha','>=',$sql2)
        ->where('compras.fecha','<=',$sql4)->whereHas('detallecompras.productos', function($query) use ($sql6) {
            $query->where('categoria_id','LIKE', $sql6);
        })->whereHas('detallecompras.productos', function($query) use ($sql5) {
            $query->where('proveedor_id','LIKE',$sql5);
        })->where('compras.estado','=','Registrado')->orderBy('compras.id','asc')->get();

        $proveedor=DB::table('proveedors as p')
        ->where('p.id','=',$sql5)
        ->first();

        $producto=Producto::where('id','=',$sql6)
        ->first();

        
        $pdf= \PDF::loadView('pdf.compraspdf',compact('compras','sql2','sql4','sql5','sql6','proveedor','producto'))->setPaper('a4');
        return $pdf->download('ReporteCompras.pdf');
    }

    public function comprasexcel(Request $request,$sql2,$sql4,$sql5,$sql6)
    {
        return Excel::download(new ComprasExports($sql2,$sql4,$sql5,$sql6), 'compras.xlsx');
    }

    public function ventas(Request $request)
    {
        $mytime= Carbon::now('America/Lima');
        if($request->buscarFechaInicio==""){
            $sql2 = $mytime->toDateString();
        }else{
            $sql2 = $request->buscarFechaInicio;
        }
        if($request->buscarFechaFin==""){
            $sql2 = $mytime->toDateString();
            $sql3=$mytime->toDateString();
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }else{
            $sql3=trim($request->buscarFechaFin);
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }
        if($request->buscarUsuario==0){
            $sql5 = "%%";
        }else{
            $sql5 = $request->buscarUsuario;
        }
        if($request->buscarSucursal==0){
            $sql6 = "%%";
        }else{
            $sql6 = $request->buscarSucursal;
        }
        if($request->buscarProducto==0){
            $sql7 = "%%";
        }else{
            $sql7 = $request->buscarProducto;
        }

        $ventas=Venta::where('fecha','>=',$sql2)
        ->where('fecha','<=',$sql4)
        ->where('idUsuario','LIKE',$sql5)
        ->where('idSucursal','LIKE',$sql6)
        ->whereHas('detalleventas.productos', function($query) use ($sql7) {
            $query->where('categoria_id','LIKE', $sql7);
        })
        ->orderBy('id','asc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $usuarios=DB::table('users as u')->orderBy('u.nombre','ASC')->get();
        $sucursales=DB::table('sucursals as s')->orderBy('s.nombre','ASC')->get();
        $productos=DB::table('categorias as p')->orderBy('p.nombre','ASC')->get();
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('reporte.ventas',compact('usuario','usuarios','productos','ventas','sql2','sql3','sql4','sql5','sql6','sql7','pacientes','sucursales'));
    }

    public function ventaspdf(Request $request,$sql2,$sql4,$sql5,$sql6,$sql7)
    {
        $ventas=Venta::where('fecha','>=',$sql2)
        ->where('fecha','<=',$sql4)
        ->where('idUsuario','LIKE',$sql5)
        ->where('idSucursal','LIKE',$sql6)
        ->whereHas('detalleventas.productos', function($query) use ($sql7) {
            $query->where('categoria_id','LIKE', $sql7);
        })
        ->orderBy('id','asc')
        ->get();

        $usuario=DB::table('users as u')
        ->where('u.id','=',$sql5)
        ->first();

        $sucursal=DB::table('sucursals as s')
        ->where('s.id','=',$sql6)
        ->first();

        $producto=Producto::where('id','=',$sql7)
        ->first();

        
        $pdf= \PDF::loadView('pdf.ventaspdf',compact('ventas','sql2','sql4','sql5','sql6','sql7','usuario','producto','sucursal'))->setPaper('a4');
        return $pdf->download('ReporteVentas.pdf');
    }

    public function ventasexcel(Request $request,$sql2,$sql4,$sql5,$sql6,$sql7)
    {
        return Excel::download(new VentasExports($sql2,$sql4,$sql5,$sql6,$sql7), 'ventas.xlsx');
    }
    public function historia(Request $request)
    {
        $mytime= Carbon::now('America/Lima');
        if($request->buscarFechaInicio==""){
            $sql2 = $mytime->toDateString();
        }else{
            $sql2 = $request->buscarFechaInicio;
        }
        if($request->buscarFechaFin==""){
            $sql2 = $mytime->toDateString();
            $sql3=$mytime->toDateString();
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }else{
            $sql3=trim($request->buscarFechaFin);
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }
        if($request->buscarUsuario==0){
            $sql5 = "%%";
        }else{
            $sql5 = $request->buscarUsuario;
        }
        if($request->buscarSucursal==0){
            $sql6 = "%%";
        }else{
            $sql6 = $request->buscarSucursal;
        }
        if($request->buscarPaciente==0){
            $sql7 = "%%";
        }else{
            $sql7 = $request->buscarPaciente;
        }

        $historias=DB::table('medidas as m')->join('users as u','m.idUsuario','=','u.id')->join('sucursals as s','m.idSucursal','=','s.id')
        ->join('pacientes as p','m.idPaciente','=','p.id')
        ->select('m.id','p.nombre as paciente','u.nombre as usuario','s.nombre as sucursal','m.fecha','m.idPaciente')
        ->where('m.fecha','>=',$sql2)
        ->where('m.fecha','<=',$sql4)
        ->where('m.idUsuario','LIKE',$sql5)
        ->where('m.idSucursal','LIKE',$sql6)
        ->where('m.idPaciente','LIKE',$sql7)
        ->orderBy('m.id','asc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $usuarios=DB::table('users as u')->orderBy('u.nombre','ASC')->get();
        $sucursales=DB::table('sucursals as s')->orderBy('s.nombre','ASC')->get();
        $paciente=DB::table('pacientes as p')->orderBy('p.nombre','ASC')->get();
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('reporte.historia',compact('usuario','usuarios','paciente','historias','sql2','sql3','sql4','sql5','sql6','sql7','pacientes','sucursales'));
    }

    public function historiapdf(Request $request,$sql2,$sql4,$sql5,$sql6,$sql7)
    {
        $historias=DB::table('medidas as m')->join('users as u','m.idUsuario','=','u.id')->join('sucursals as s','m.idSucursal','=','s.id')
        ->join('pacientes as p','m.idPaciente','=','p.id')
        ->select('m.id','p.nombre as paciente','u.nombre as usuario','s.nombre as sucursal','m.fecha','m.idPaciente')
        ->where('m.fecha','>=',$sql2)
        ->where('m.fecha','<=',$sql4)
        ->where('m.idUsuario','LIKE',$sql5)
        ->where('m.idSucursal','LIKE',$sql6)
        ->where('m.idPaciente','LIKE',$sql7)
        ->orderBy('m.id','asc')
        ->get();

        $usuario=DB::table('users as u')
        ->where('u.id','=',$sql5)
        ->first();

        $sucursal=DB::table('sucursals as s')
        ->where('s.id','=',$sql6)
        ->first();

        $paciente=DB::table('pacientes as p')
        ->where('p.id','=',$sql7)
        ->first();

        
        $pdf= \PDF::loadView('pdf.historiapdf',compact('historias','sql2','sql4','sql5','sql6','sql7','usuario','paciente','sucursal'))->setPaper('a4');
        return $pdf->download('ReporteHistorias.pdf');
    }

    public function historiaexcel(Request $request,$sql2,$sql4,$sql5,$sql6,$sql7)
    {
        return Excel::download(new HistoriaExports($sql2,$sql4,$sql5,$sql6,$sql7), 'historia.xlsx');
    }
    public function cajas(Request $request)
    {
        $mytime= Carbon::now('America/Lima');
        if($request->buscarFechaInicio==""){
            $sql2 = $mytime->toDateString();
        }else{
            $sql2 = $request->buscarFechaInicio;
        }
        if($request->buscarFechaFin==""){
            $sql2 = $mytime->toDateString();
            $sql3=$mytime->toDateString();
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }else{
            $sql3=trim($request->buscarFechaFin);
            $sql4=date("Y-m-d",strtotime($sql3."+ 1 days"));
        }
        if($request->buscarUsuario==0){
            $sql5 = "%%";
        }else{
            $sql5 = $request->buscarUsuario;
        }
        if($request->buscarSucursal==0){
            $sql6 = "%%";
        }else{
            $sql6 = $request->buscarSucursal;
        }
        if($request->buscarMedio==0){
            $sql7 = "%%";
        }else{
            $sql7 = $request->buscarMedio;
        }

        $cajas=DB::table('cajas as c')->join('users as u','c.idUsuario','=','u.id')->join('sucursals as s','c.idSucursal','=','s.id')
        ->join('medios as m','c.idMedios','=','m.id')
        ->select('c.id','m.nombre as medio','m.banco','u.nombre as usuario','s.nombre as sucursal','c.fecha','c.tipo','c.descripcion','c.monto')
        ->where('c.fecha','>=',$sql2)
        ->where('c.fecha','<=',$sql4)
        ->where('c.idUsuario','LIKE',$sql5)
        ->where('c.idSucursal','LIKE',$sql6)
        ->where('c.idMedios','LIKE',$sql7)
        ->orderBy('c.id','asc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $usuarios=DB::table('users as u')->orderBy('u.nombre','ASC')->get();
        $sucursales=DB::table('sucursals as s')->orderBy('s.nombre','ASC')->get();
        $medios=DB::table('medios as m')->orderBy('m.nombre','ASC')->get();
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('reporte.cajas',compact('usuario','usuarios','medios','cajas','sql2','sql3','sql4','sql5','sql6','sql7','pacientes','sucursales'));
    }

    public function cajaspdf(Request $request,$sql2,$sql4,$sql5,$sql6,$sql7)
    {
        $cajas=DB::table('cajas as c')->join('users as u','c.idUsuario','=','u.id')->join('sucursals as s','c.idSucursal','=','s.id')
        ->join('medios as m','c.idMedios','=','m.id')
        ->select('c.id','m.nombre as medio','m.banco','u.nombre as usuario','s.nombre as sucursal','c.fecha','c.tipo','c.descripcion','c.monto')
        ->where('c.fecha','>=',$sql2)
        ->where('c.fecha','<=',$sql4)
        ->where('c.idUsuario','LIKE',$sql5)
        ->where('c.idSucursal','LIKE',$sql6)
        ->where('c.idMedios','LIKE',$sql7)
        ->orderBy('c.id','asc')
        ->get();

        $usuario=DB::table('users as u')
        ->where('u.id','=',$sql5)
        ->first();

        $sucursal=DB::table('sucursals as s')
        ->where('s.id','=',$sql6)
        ->first();

        $medio=DB::table('medios as m')
        ->where('m.id','=',$sql7)
        ->first();

        
        $pdf= \PDF::loadView('pdf.cajaspdf',compact('cajas','sql2','sql4','sql5','sql6','sql7','usuario','medio','sucursal'))->setPaper('a4');
        return $pdf->download('ReporteCajas.pdf');
    }

    public function cajasexcel(Request $request,$sql2,$sql4,$sql5,$sql6,$sql7)
    {
        return Excel::download(new CajasExports($sql2,$sql4,$sql5,$sql6,$sql7), 'cajas.xlsx');
    }
    public function productos(Request $request)
    {
        if($request){
            if($request->buscarProducto==""){
                $sql = 1;
            }else{
                $sql = $request->buscarProducto;
            }
            
            $sql2 = $request->buscarTexto;
            $sql3 = $request->buscarTexto2;
            $sql4 = $request->buscarTexto3;
            $productos=Producto::where('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
                $query->where('nombre','LIKE', '%'.$sql2.'%');
            })->where('stock','>',0)->whereHas('caracteristicas', function($query) use ($sql3) {
                $query->where('nombre','LIKE', '%'.$sql3.'%');
            })->where('precio','LIKE','%'.$sql4.'%')->where('estado','Registrado')->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
                $query->where('nombre','LIKE', '%'.$sql2.'%');
            })->whereHas('caracteristicas', function($query) use ($sql3) {
                $query->where('nombre','LIKE', '%'.$sql3.'%');
            })->where('codigo','LIKE','%'.$sql4.'%')->where('stock','>',0)->where('estado','Registrado')->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
                $query->where('nombre','LIKE', '%'.$sql2.'%');
            })->whereHas('caracteristicas', function($query) use ($sql3) {
                $query->where('nombre','LIKE', '%'.$sql3.'%');
            })->whereHas('proveedor', function($query) use ($sql4) {
                $query->where('nombre','LIKE', '%'.$sql4.'%');
            })->where('stock','>',0)->where('estado','Registrado')->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
                $query->where('nombre','LIKE', '%'.$sql2.'%');
            })->whereHas('caracteristicas', function($query) use ($sql3) {
                $query->where('nombre','LIKE', '%'.$sql3.'%');
            })->whereHas('sucursal', function($query) use ($sql4) {
                $query->where('nombre','LIKE', '%'.$sql4.'%');
            })->where('stock','>',0)->where('estado','Registrado')->get();
            $categorias=Categoria::where('estado','1')->orderBy('id','asc')->get();
            $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
            ->where('u.id','=',\Auth::user()->id)
            ->select('u.id','u.nombre','s.nombre as sucursal')
            ->get();
            
            $categoria12 = Categoria::where('id','=',$sql)->first();
            
            $sucursales=Sucursal::where('estado','1')->orderBy('id','asc')->get();
            return view('reporte.productos',compact('productos','usuario','categorias','sql','sql2','sql3','sql4','categoria12','sucursales'));
        }
    }

    public function productospdf(Request $request,$sql,$sql2,$sql3,$sql4)
    {
        $productos=Producto::where('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
            $query->where('nombre','LIKE', '%'.$sql2.'%');
        })->whereHas('caracteristicas', function($query) use ($sql3) {
            $query->where('nombre','LIKE', '%'.$sql3.'%');
        })->where('precio','LIKE','%'.$sql4.'%')->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
            $query->where('nombre','LIKE', '%'.$sql2.'%');
        })->whereHas('caracteristicas', function($query) use ($sql3) {
            $query->where('nombre','LIKE', '%'.$sql3.'%');
        })->where('codigo','LIKE','%'.$sql4.'%')->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
            $query->where('nombre','LIKE', '%'.$sql2.'%');
        })->whereHas('caracteristicas', function($query) use ($sql3) {
            $query->where('nombre','LIKE', '%'.$sql3.'%');
        })->whereHas('proveedor', function($query) use ($sql4) {
            $query->where('nombre','LIKE', '%'.$sql4.'%');
        })->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
            $query->where('nombre','LIKE', '%'.$sql2.'%');
        })->whereHas('caracteristicas', function($query) use ($sql3) {
            $query->where('nombre','LIKE', '%'.$sql3.'%');
        })->whereHas('sucursal', function($query) use ($sql4) {
            $query->where('nombre','LIKE', '%'.$sql4.'%');
        })->get();
        $categorias=Categoria::where('estado','1')->orderBy('id','asc')->get();
        $categoria12 = Categoria::where('id','=',$sql)->first();
        
        $pdf= \PDF::loadView('pdf.productospdf',compact('productos','categorias','sql','sql2','sql3','sql4','categoria12'))->setPaper('a4','landscape');
        return $pdf->download('ReporteProductos.pdf');
    }

    public function productosexcel(Request $request,$sql,$sql2,$sql3,$sql4)
    {
        return Excel::download(new ProductosExports($sql,$sql2,$sql3,$sql4), 'inventario.xlsx');
    }
}
