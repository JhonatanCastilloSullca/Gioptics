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
use App\Models\Producto;
use App\Models\Categoria;

class ProductosExports implements FromView, ShouldAutoSize, WithEvents, WithHeadings, WithDrawings
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
                    'A4:Z4',
                    [
                        
                        'font' => [
                            'size' => 13,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A4:Z4',
                    [
                        
                        'font' => [
                            'bold' => true,
                        ],
                    ]
                );
                
            },
        ];
    }
    
    

    public function __construct($sql,$sql2,$sql3,$sql4)
    {
        $this->sql = $sql;
        $this->sql2 = $sql2;
        $this->sql3 = $sql3;
        $this->sql4 = $sql4;
    }

    public function view(): View
    {
        $mytime= Carbon::now('America/Lima');
        $sql=$this->sql;
        $sql2=$this->sql2;
        $sql3=$this->sql3;
        $sql4=$this->sql4;
        $productos=Producto::where('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
            $query->where('nombre','LIKE', '%'.$sql2.'%');
        })->whereHas('caracteristicas', function($query) use ($sql3) {
            $query->where('nombre','LIKE', '%'.$sql3.'%');
        })->where('precio','LIKE','%'.$sql4.'%')->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
            $query->where('nombre','LIKE', '%'.$sql2.'%');
        })->whereHas('caracteristicas', function($query) use ($sql3) {
            $query->where('nombre','LIKE', '%'.$sql3.'%');
        })->where('codigo','LIKE','%'.$sql4.'%')->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
            $query->where('nombre','LIKE', '%'.$sql2.'%');
        })->whereHas('caracteristicas', function($query) use ($sql3) {
            $query->where('nombre','LIKE', '%'.$sql3.'%');
        })->whereHas('proveedor', function($query) use ($sql4) {
            $query->where('nombre','LIKE', '%'.$sql4.'%');
        })->orWhere('categoria_id',$sql)->whereHas('caracteristicas', function($query) use ($sql2) {
            $query->where('nombre','LIKE', '%'.$sql2.'%');
        })->whereHas('caracteristicas', function($query) use ($sql3) {
            $query->where('nombre','LIKE', '%'.$sql3.'%');
        })->whereHas('sucursal', function($query) use ($sql4) {
            $query->where('nombre','LIKE', '%'.$sql4.'%');
        })->get();
        $categorias=Categoria::where('estado','1')->orderBy('id','asc')->get();
        $categoria12 = Categoria::where('id','=',$sql)->first();
        return view('excel.productosexcel', compact('productos','categorias','sql','sql2','sql3','sql4','categoria12'));
    }
}
