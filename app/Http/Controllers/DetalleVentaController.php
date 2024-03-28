<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class DetalleVentaController extends Controller
{
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $requ=\Validator::make($request->all(), [
                'cantidad' => 'required',
                'idProducto' => 'required',
                'precio' => 'required|numeric',
            ]);
            if ($requ->fails())
            {
                return Redirect::back()->with('error_code', 6)->withErrors($requ->errors())->withInput();
    
            }

            $mytime= Carbon::now('America/Lima');
            $detalle = new DetalleVenta();
            $detalle->idventa = $venta->id;
            $detalle->idproducto = $id_producto[$cont];
            $detalle->cantidad = $cantidad[$cont];
            $detalle->precio = $precio[$cont];
            $detalle->save();
            $cont=$cont+1;
                
            DB::commit();

        } catch(Exception $e){
            
            DB::rollBack();
        }

    }
}
