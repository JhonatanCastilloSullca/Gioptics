<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleCompra;
use App\Models\ProductoCaracteristica;
use App\Models\Producto;
use Illuminate\Support\Facades\Redirect;

class DetalleCompraController extends Controller
{
    public function store(Request $request)
{       
        $requ=\Validator::make($request->all(), [
        'codigo' => 'required',
        'stock' => 'required',
        'precio' => 'required|numeric',
        'precio_compra' => 'required|numeric',
        'proveedor_id' => 'required',
        'categoria_id' => 'required',
        'sucursal_id' => 'required',
        'unidad_id' => 'required',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 6)->withErrors($requ->errors())->withInput();

        }
        $producto = new Producto();          
        $producto->nombre = $request->categoria_id;
        $producto->codigo = $request->codigo;
        $producto->stock = $request->stock;
        $producto->precio = $request->precio;
        $producto->precio_compra = $request->precio_compra;
        $producto->estado = 'Pendiente';
        $producto->proveedor_id = $request->proveedor_id;
        $producto->categoria_id = $request->categoria_id;
        $producto->sucursal_id = $request->sucursal_id;
        $producto->unidad_id = $request->unidad_id;     
        $producto->save();

        $caracteristica=$request->caracteristica_id;
        $cont=0;
        while($cont < count($caracteristica))
        {
            $productocat = new ProductoCaracteristica();          
            $productocat->caracteristica_id = $caracteristica[$cont]; 
            $productocat->producto_id = $producto->id;
            $productocat->save();
            $cont++;

        }
        $detalle = new DetalleCompra();          
        $detalle->idCompra = $request->compra_id; 
        $detalle->idProducto = $producto->id;
        $detalle->cantidad=$request->stock;
        $detalle->precio=$request->precio_compra;
        $detalle->especificacion=$request->especificacion;
        $detalle->save();  
        
        return redirect()->back()->with('success','Categoria Modificado Correctamente!');
    }
}
