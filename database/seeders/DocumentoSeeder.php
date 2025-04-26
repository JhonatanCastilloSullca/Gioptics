<?php

namespace Database\Seeders;

use App\Models\Documento;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documento::create([
            'nombre'       =>    'NOTA DE VENTA',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'NP',
            'serie'        =>    'N001',
            'sucursal_id'        =>    '1',
        ]);
        Documento::create([
            'nombre'       =>    'BOLETA DE VENTA ELECTRÓNICA',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'BV',
            'codSunat'=>    '03',
            'serie'        =>    'B001',
            'sucursal_id'        =>    '1',
        ]);
        Documento::create([
            'nombre'       =>    'FACTURA ELECTRÓNICA',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'F',
            'codSunat'=>    '01',
            'serie'        =>    'F001',
            'sucursal_id'        =>    '1',
        ]);
        Documento::create([
            'nombre'       =>    'NOTA DE CRÉDITO',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'BV',
            'codSunat'=>    '07',
            'serie'        =>    'BC01',
            'sucursal_id'        =>    '1',
        ]);
        Documento::create([
            'nombre'       =>    'NOTA DE CRÉDITO',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'F',
            'codSunat'=>    '07',
            'serie'        =>    'FC01',
            'sucursal_id'        =>    '1',
        ]);

        Documento::create([
            'nombre'       =>    'NOTA DE VENTA',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'NP',
            'serie'        =>    'N002',
            'sucursal_id'        =>    '2',
        ]);
        Documento::create([
            'nombre'       =>    'BOLETA DE VENTA ELECTRÓNICA',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'BV',
            'codSunat'=>    '03',
            'serie'        =>    'B002',
            'sucursal_id'        =>    '2',
        ]);
        Documento::create([
            'nombre'       =>    'FACTURA ELECTRÓNICA',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'F',
            'codSunat'=>    '01',
            'serie'        =>    'F002',
            'sucursal_id'        =>    '2',
        ]);
        Documento::create([
            'nombre'       =>    'NOTA DE CRÉDITO',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'BV',
            'codSunat'=>    '07',
            'serie'        =>    'BC02',
            'sucursal_id'        =>    '2',
        ]);
        Documento::create([
            'nombre'       =>    'NOTA DE CRÉDITO',
            'incremento'   =>    '1',
            'cantidad'    =>    '0',
            'abreviatura'=>    'F',
            'codSunat'=>    '07',
            'serie'        =>    'FC02',
            'sucursal_id'        =>    '2',
        ]);
    }
}
