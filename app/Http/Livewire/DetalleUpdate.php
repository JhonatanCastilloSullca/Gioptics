<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;

class DetalleUpdate extends Component
{
    public $idTour;
    public $idHotel;
    public $fecha;
    public $numero;
    public $precio;
    public $ingreso;
    public $observacion;

    protected $rules = [
        'idTour' => 'required',
        'idHotel' => 'required',
        'fecha' => 'required|date',
        'numero' => 'required|integer|min:1',
        'precio' => 'required|min:1',
        'ingreso' => 'nullable',
        'observacion' => 'nullable',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validation=$this->validate();
        DetalleReserva::create($validation);
    }

    public function mount() {
        if (old('observacion_e')) {
	        $this->observacion = old('observacion_e');
        }
    }

    public function render()
    {
        $hoteles=DB::table('hotels')->orderBy('hotels.id','desc')->get();
        $tours=DB::table('tours')->orderBy('tours.nombre','asc')->get();
        return view('livewire.detalle-update',compact('tours','hoteles'));
    }
}
