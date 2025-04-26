<?php

namespace Database\Seeders;

use App\Models\Medio;
use Illuminate\Database\Seeder;

class MedioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medio::create([
            'nombre'       =>    'EFECTIVO',
            'banco'   =>    'EFECTIVO',
            'numero'    =>    '1',
            'moneda'=>    'SOLES',
            'descripcion'        =>    'EFECTIVO',
            'estado'        =>    'Registrado',
        ]);
    }
}
