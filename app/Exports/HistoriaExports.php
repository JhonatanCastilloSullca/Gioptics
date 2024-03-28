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

class HistoriaExports implements FromView, ShouldAutoSize, WithEvents, WithHeadings, WithDrawings
{
    use Exportable;

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath('img/logogo.png');
        $drawing->setHeight(38);
        $drawing->setCoordinates('D1');

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
                    'A5:D5',
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
                    'A5:D5',
                    [
                        
                        'font' => [
                            'size' => 13,
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A5:D5',
                    [
                        
                        'font' => [
                            'bold' => true,
                        ],
                    ]
                );
                
            },
        ];
    }
    
    

    public function __construct($sql2,$sql4,$sql5,$sql6,$sql7)
    {
        $this->sql2 = $sql2;
        $this->sql4 = $sql4;
        $this->sql5 = $sql5;
        $this->sql6 = $sql6;
        $this->sql7 = $sql7;
    }

    public function view(): View
    {
        $mytime= Carbon::now('America/Lima');
        $sql2=$this->sql2;
        $sql4=$this->sql4;
        $sql5=$this->sql5;
        $sql6=$this->sql6;
        $sql7=$this->sql7;

        $historias=DB::table('medidas as m')->join('users as u','m.idUsuario','=','u.id')->join('sucursals as s','m.idSucursal','=','s.id')
        ->join('pacientes as p','m.idPaciente','=','p.id')
        ->select('m.id','p.nombre as paciente','u.nombre as usuario','s.nombre as sucursal','m.fecha','m.idPaciente')
        ->where('m.fecha','>=',$sql2)
        ->where('m.fecha','<=',$sql4)
        ->where('m.idUsuario','LIKE',$sql5)
        ->where('m.idSucursal','LIKE',$sql6)
        ->where('m.idPaciente','LIKE',$sql7)
        ->orderBy('m.id','asc')
        ->get();

        $usuario=DB::table('users as u')
        ->where('u.id','=',$sql5)
        ->first();

        $sucursal=DB::table('sucursals as s')
        ->where('s.id','=',$sql6)
        ->first();

        $paciente=DB::table('pacientes as p')
        ->where('p.id','=',$sql7)
        ->first();

        return view('excel.historiaexcel', compact('historias','sql2','sql4','sql5','sql6','sql7','usuario','paciente','sucursal'));
    }
}
