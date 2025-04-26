<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'razon_social' => "BECERRA ALEGRIA SHEILA PATRICIA",
            'ruc' => "10446103071",
            'direccion' => "CALLE MATARA NRO. 242 CENTRO HISTORICO",
            'sol_user' => "48507551",
            'sol_pass' => "Goptics2024",
            'client_id' => null,
            'client_secret' => null,
            'distrito' => "CUSCO", 
            'provincia' => "CUSCO", 
            'departamento' => "CUSCO", 
            'ubigeo' => "080101", 
            'production' => 0,
        ]);
    }
}
