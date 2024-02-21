<?php

namespace App\Exports;

use App\Models\AccessModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAccess implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $batch;

    public function __construct($batch)
    {
        $this->batch = $batch;
    }

    public function collection()
    {
        $acceses = AccessModel::where('batch', $this->batch)->get();
        foreach ($acceses as $row) {
            $access[] = array(
                '0' => $row->id,
                '1' => $row->batch,
                '2' => $row->product_id,
                '3' => $row->product_name,
                '4' => $row->quantity,
                '5' => $row->agent,
                '6' => $row->year_create,
            );
        }

        return (collect($access));
    }

    public function headings(): array
    {
        return [
            'id',
            'Mã lô hàng',
            'Mã sản phẩm',
            'Tên sản phẩm',
            'Số lượng',
            'Nhà sản xuất',
            'Năm sản xuất',
        ];
    }
}
