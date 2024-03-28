<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Sheet;
use Carbon\Carbon;
use DB;
use App\Models\Compra;
use App\Models\Producto;

class ComprasExports implements FromView, ShouldAutoSize, WithEvents, WithHeadings, WithDrawings
{
    use Exportable;

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath('img/logogo.png');
        $drawing->setHeight(38);
        $drawing->setCoordinates('E1');

        return $drawing;
    }


    public function headings(): array
    {
        return [
            'No',
            'Order date',
            'Design',
            'Length',
            'Width',
            'Color',
            'No Shortage',
            'Area',
            'Shortage',
            'Customer',
            'Delivery Date'
        ];
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(15);
                $event->sheet->styleCells(
                    'A4:E4',
                    [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => '94c11f',
                             ]           
                            ],
                        'font' => ['color' => ['argb'=> 'ffffff']],
                    ]
                );
                $event->sheet->styleCells(
                    'A2:B4',
                    [
                        'font' => [
                            'size' => 12,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A3:B3',
                    [
                        'font' => [
                            'size' => 12,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A1',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                        'font' => [
                            'bold' => true,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'E2',
                    [
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A4:E4',
                    [
                        
                        'font' => [
                            'size' => 13,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A4:E4',
                    [
                        
                        'font' => [
                            'bold' => true,
                        ],
                    ]
                );
                
            },
        ];
    }
    
    

    public function __construct($sql2,$sql4,$sql5,$sql6)
    {
        $this->sql2 = $sql2;
        $this->sql4 = $sql4;
        $this->sql5 = $sql5;
        $this->sql6 = $sql6;
    }

    public function view(): View
    {
        $mytime= Carbon::now('America/Lima');
        $sql2=$this->sql2;
        $sql4=$this->sql4;
        $sql5=$this->sql5;
        $sql6=$this->sql6;
        $compras=Compra::where('compras.fecha','>=',$sql2)
        ->where('compras.fecha','<=',$sql4)->whereHas('detallecompras.productos', function($query) use ($sql6) {
            $query->where('categoria_id','LIKE', $sql6);
        })->whereHas('detallecompras.productos', function($query) use ($sql5) {
            $query->where('proveedor_id','LIKE',$sql5);
        })->where('compras.estado','=','Registrado')->orderBy('compras.id','asc')->get();

        $proveedor=DB::table('proveedors as p')
        ->where('p.id','=',$sql5)
        ->first();

        $producto=Producto::where('id','=',$sql6)
        ->first();
        return view('excel.comprasexcel', compact('compras','sql2','sql4','sql5','sql6','proveedor','producto'));
    }
}
