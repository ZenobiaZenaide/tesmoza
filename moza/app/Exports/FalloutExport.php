<?php

namespace App\Exports;

use App\Models\Fallout;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FalloutExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {
        return Fallout::select('order_id', 'status_message', 'sto', 'tanggal_fallout', 'pic', 'status', 'ket')->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Status Message',
            'STO',
            'Tanggal Fallout',
            'PIC',
            'Status',
            'Keterangan'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Atur gaya untuk heading
            'A1:G1' => ['font' => ['bold' => true]],
        ];
    }
}
