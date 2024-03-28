<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\Producto;

class ShowCategoria extends Component
{
    public $selectCategorias = null;
    public $productos = null;
    
    public function render()
    {   
        $categorias=Categoria::where('estado','=','1')->get();
        return view('livewire.show-categoria',compact('categorias'));
    }

    public function updatedselectCategorias($categoria_id)
    {
        $this->dispatchBrowserEvent('contentChanged');
        $this->productos=Producto::where('idCategoria','=',$categoria_id)->get();
    }
}
