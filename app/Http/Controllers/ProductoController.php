<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Sucursal;
use App\Models\ProductoCaracteristica;
use Illuminate\Support\Facades\Redirect;
use DB;

class ProductoController extends Controller
{
    //
    public function index(Request $request)
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
            return view('producto.index',compact('productos','usuario','categorias','sql','sql2','sql3','sql4','categoria12','sucursales'));
        }
        
    }

    public function store(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'nombre' => 'required',
            'codigo' => 'required',
            'modelo' => 'nullable',
            'color' => 'nullable',          
            'precio' => 'required',
            'precio_compra' => 'required',
        ]);
        
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }
        


        $productos= new Producto();
        $productos->nombre = $request->nombre;
        $productos->codigo = $request->codigo;
        $productos->modelo = $request->modelo;
        $productos->color =  $request->color;
        $productos->stock =  1;
        $productos->precio = $request->precio;
        $productos->precio_compra = $request->precio_compra;
        $productos->estado = $request->estado;
        $productos->idCategoria = $request->idCategoria;        
        $productos->estado = "1";
        $productos->save();
        return Redirect::to("producto"); 
    }

    public function update(Request $request)
    {
        $requ=\Validator::make($request->all(), [
            'cantidad' => 'required',
            'idSucursal' => 'required',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();

        }

        $productos= Producto::findOrFail($request->id_producto2);
        
        $producto= new Producto();
        $producto->nombre=1;
        $producto->codigo=$productos->codigo;
        $producto->stock=$request->cantidad;
        $producto->precio=$productos->precio;
        $producto->precio_compra=$productos->precio_compra;
        $producto->estado=$productos->estado;
        $producto->proveedor_id=$productos->proveedor_id;
        $producto->categoria_id=$productos->categoria_id;
        $producto->sucursal_id=$request->idSucursal;
        $producto->unidad_id=$productos->unidad_id;
        $producto->save();
        
        $productos->stock=$productos->stock-$request->cantidad;
        $productos->save();
        
        foreach($productos->caracteristicas as $caracteristica){
            $productocat = new ProductoCaracteristica();          
            $productocat->caracteristica_id = $caracteristica->id; 
            $productocat->producto_id = $producto->id;
            $productocat->save();
        }
        
        return redirect()->back()->with('success','Producto Modificado Correctamente!');
    }

    public function destroy(Request $request)
    {
        $productos= Producto::findOrFail($request->id_enviar);
         if($productos->estado=="1"){
            $productos->estado= '0';
            $productos->save();
            return redirect()->back()->with('success','Producto Eliminado Correctamente!');
        }else{
            $productos->estado= '1';
            $productos->save();            
            return redirect()->back()->with('success','Producto Activado Correctamente!');
        }
    }

    public function prueba()
    {
        
        return Producto::join('categorias as c','productos.idCategoria','=','c.id')->select('productos.id','productos.nombre','productos.codigo','productos.modelo','productos.color','productos.stock','productos.precio','c.nombre as categoria','productos.estado','productos.precio_compra','c.tipo as tipoproducto','productos.idCategoria')->where('productos.stock','>','0')->get();
    }

    public function prueba2()
    {
        
        return Producto::join('categorias as c','productos.idCategoria','=','c.id')->select('productos.id','productos.nombre','productos.codigo','productos.modelo','productos.color','productos.stock','productos.precio','c.nombre as categoria','productos.estado','productos.precio_compra','c.tipo as tipoproducto','productos.idCategoria')->get();
    }

}
