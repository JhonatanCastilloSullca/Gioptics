<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sucursal::create([
            'id'            => '1',
            'nombre'        => 'G-Optics',
            'direccion'     =>  "Calle Matara",
            'telefono'     =>  "987645321",
            'estado'        =>  1,
        ]);

        Sucursal::create([
            'id'            => '2',
            'nombre'        => 'G-Store',
            'direccion'     =>  "Calle Matara",
            'telefono'     =>  "987645321",
            'estado'        =>  1,
        ]);
    }
}
