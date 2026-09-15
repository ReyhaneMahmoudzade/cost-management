<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PartsTemplateExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    public function collection(): Collection
    {
        return collect([
            ['شفت اصلی', 'P-1001', 'قطعات مکانیزم LBS', 'ساخته شده', '1200', '350', '80', 'توضیح نمونه'],
            ['پوسته موتور', 'P-1002', 'محفظه و متعلقات', '', '', '', '', ''],
        ]);
    }

    public function headings(): array
    {
        return [
            'نام قطعه *',
            'کد قطعه *',
            'گروه کالا',
            'ماهیت',
            'وزن (گرم)',
            'مساحت (میلی‌متر مربع)',
            'محیط (میلی‌متر)',
            'سایر اطلاعات',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 18,
            'C' => 30,
            'D' => 18,
            'E' => 15,
            'F' => 22,
            'G' => 18,
            'H' => 30,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
