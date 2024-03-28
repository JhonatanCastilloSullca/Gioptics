<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaCompra;

class CategoriaCompraController extends Controller
{
    public function store(Request $request)
    {
        $productocat = new CategoriaCompra();          
        $productocat->categoria_id = $request->categoria_id; 
        $productocat->compra_id = $request->compra_id;
        $productocat->save();
        return redirect()->back()->with('success','Categoria Modificado Correctamente!');        
    }
}
