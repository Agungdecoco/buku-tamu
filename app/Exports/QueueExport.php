<?php

namespace App\Exports;

use App\Models\Queue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
// use Maatwebsite\Excel\Concerns\FromCollection;

class QueueExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Queue::all();
    // }

    public function view(): View
    {
        return view('admin.export',['data' => Queue::all()
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:M1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);

            // $styleArray = [
            //     'borders' => [
            //         'outline' => [
            //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            //             'color' => ['argb' => 'FFFF0000'],
            //         ]
            //     ]
            //         ];

            //     $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

            //     $event->sheet->getDelegate()->getStyle('A1:M1')
            //     ->getAlignment()->setWrapText(true);
            },
        ];
    }
    
}
