<?php

namespace App\Imports;

use App\Models\Part;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PartsImport implements ToCollection
{
    public int $created = 0;

    /** @var array<int, array{row:int, code:string|null}> */
    public array $skipped = [];

    /** @var array<int, array{row:int, messages:array}> */
    public array $errors = [];

    /** @var array<string, bool> */
    protected array $existingCodes = [];

    /** @var array<string, bool> */
    protected array $seenInFile = [];

    public function collection(Collection $rows)
    {
        $this->existingCodes = Part::pluck('code')
            ->map(fn ($c) => mb_strtolower(trim((string) $c)))
            ->flip()
            ->toArray();

        foreach ($rows as $index => $row) {
            $excelRow = $index + 1;

            // ردیف اول = هدر فارسی قالب، نادیده گرفته می‌شود
            if ($index === 0) {
                continue;
            }

            $values = $row instanceof Collection ? $row->values() : collect($row)->values();

            $name = $this->normalizeString($values->get(0));
            $code = $this->normalizeString($values->get(1));
            $group = $this->normalizeString($values->get(2));
            $type = $this->normalizeString($values->get(3));
            $weight = $this->normalizeNumber($values->get(4));
            $area = $this->normalizeNumber($values->get(5));
            $perimeter = $this->normalizeNumber($values->get(6));
            $description = $this->normalizeString($values->get(7));

            // ردیف کاملاً خالی → نادیده بگیر
            if ($name === '' && $code === '' && $group === '' && $type === ''
                && $weight === null && $area === null && $perimeter === null && $description === '') {
                continue;
            }

            $messages = [];

            if ($name === '') {
                $messages[] = 'نام قطعه الزامی است.';
            } elseif (mb_strlen($name) > 255) {
                $messages[] = 'نام قطعه حداکثر ۲۵۵ کاراکتر باشد.';
            }

            if ($code === '') {
                $messages[] = 'کد قطعه الزامی است.';
            } elseif (mb_strlen($code) > 100) {
                $messages[] = 'کد قطعه حداکثر ۱۰۰ کاراکتر باشد.';
            }

            if (mb_strlen($group) > 255) {
                $messages[] = 'گروه کالا حداکثر ۲۵۵ کاراکتر باشد.';
            }

            if (mb_strlen($type) > 255) {
                $messages[] = 'ماهیت حداکثر ۲۵۵ کاراکتر باشد.';
            }

            foreach (['weight' => [$weight, 'وزن'], 'area' => [$area, 'مساحت'], 'perimeter' => [$perimeter, 'محیط']] as $field => [$raw, $label]) {
                if ($raw === null || $raw === '') {
                    continue;
                }
                if (! is_numeric($raw) || $raw < 0) {
                    $messages[] = "{$label} باید عدد مثبت باشد.";
                }
            }

            // سیاست A: کد تکراری در دیتابیس → رد + گزارش (بدون خطا)
            if ($code !== '') {
                $lower = mb_strtolower($code);
                if (isset($this->existingCodes[$lower])) {
                    $this->skipped[] = ['row' => $excelRow, 'code' => $code];
                    continue;
                }
                if (isset($this->seenInFile[$lower])) {
                    $messages[] = "کد «{$code}» در فایل تکراری است.";
                }
            }

            if (! empty($messages)) {
                $this->errors[] = ['row' => $excelRow, 'messages' => $messages];
                continue;
            }

            Part::create([
                'name' => $name,
                'code' => $code,
                // ستون‌های group/type/description در دیتابیس NOT NULL هستند، پس رشته خالی ذخیره می‌کنیم
                'group' => $group !== '' ? $group : '',
                'type' => $type !== '' ? $type : '',
                'weight' => ($weight === '' || $weight === null) ? null : $weight,
                'area' => ($area === '' || $area === null) ? null : $area,
                'perimeter' => ($perimeter === '' || $perimeter === null) ? null : $perimeter,
                'description' => $description !== '' ? $description : '',
            ]);

            $this->created++;
            $this->seenInFile[mb_strtolower($code)] = true;
            $this->existingCodes[mb_strtolower($code)] = true;
        }
    }

    protected function normalizeString(mixed $value): string
    {
        if ($value === null) {
            return '';
        }
        $value = $this->faToEn((string) $value);

        return trim($value);
    }

    protected function normalizeNumber(mixed $value): mixed
    {
        if ($value === null) {
            return null;
        }
        $value = trim($this->faToEn((string) $value));
        if ($value === '') {
            return null;
        }
        // حذف جداکننده هزارگان فارسی/انگلیسی
        $value = str_replace([',', '٬', '،', ' '], '', $value);

        return $value === '' ? null : $value;
    }

    protected function faToEn(string $value): string
    {
        $fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $ar = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace(array_merge($fa, $ar), $en, $value);
    }
}
