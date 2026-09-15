<?php

namespace App\Services;

class TableDataService
{
    public static function partColumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'نام', 'field' => 'name'],
            ['label' => 'کد قطعه', 'field' => 'code'],
            ['label' => 'گروه کالا', 'field' => 'group'],
            ['label' => 'ماهیت', 'field' => 'type'],
            ['label' => 'وزن', 'field' => 'weight'],
            ['label' => 'مساحت', 'field' => 'area'],
            ['label' => 'محیط', 'field' => 'perimeter'],
            ['label' => 'سایر اطلاعات', 'field' => 'description'],
            ['label' => 'عملیات', 'type'  => 'actions'],
        ]);
    }

    public static function partRoute()
    {
        return ([
            'edit'   => 'parts.edit',
            'delete' => 'parts.destroy',
        ]);
    }

    public static function partAction()
    {
        return ([
            'edit',
            'delete',
        ]);
    }


    public static function materialColumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'نام', 'field' => 'name'],
            ['label' => 'مشخصه فنی', 'field' => 'width'],
            ['label' => 'واحد', 'field' => 'unit'],
            [
                'label' => 'نرخ فعال',
                'value' => function ($row) {
                    $rate = $row->activeRate?->rate_per_unit;
                    return $rate ? number_format($rate) . ' ریال' : '-';
                },
            ],
            ['label' => 'عملیات', 'type'  => 'actions'],
        ]);
    }

    public static function materialRoute()
    {
        return ([
            'edit'   => 'materials.edit',
            'delete' => 'materials.destroy',
        ]);
    }

    public static function materialAction()
    {
        return ([
            'edit',
            'delete',
        ]);
    }


    public static function processColumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'نام', 'field' => 'name'],
            ['label' => 'واحد استاندارد', 'field' => 'standard_unit'],
            [
                'label' => 'تعداد عوامل موثر',
                'html' => function ($row) {
                    $count = $row->processFactors->count();
                    $items = $row->processFactors->map(function ($pf) {
                        return $pf->factor->name . ' (' . $pf->weight . ')';
                    })->implode('، ');
                    return '<span class="relative group">'
                        . '<span class="p-1 rounded-full bg-orange-50 hover:bg-orange-100 cursor-help">' . $count . '</span>'
                        . '<span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block z-50 w-56">'
                        . '<span class="bg-gray-800 text-white text-xs rounded-lg px-3 py-2 shadow-lg whitespace-nowrap">'
                        . ($items ?: 'بدون عامل')  
                        . '</span></span></span>';
                },
            ],
            [
                'label' => 'نرخ فعال',
                'value' => function ($row) {
                    $rate = $row->activeRate?->rate_per_unit;
                    return $rate ? number_format($rate) . ' ریال' : '-';
                },
            ],
            ['label' => 'عملیات', 'type'  => 'actions'],
        ]);
    }

    public static function processRoute()
    {
        return ([
            'edit'   => 'processes.edit',
            'delete' => 'processes.destroy',
        ]);
    }

    public static function processAction()
    {
        return ([
            'edit',
            'delete',
        ]);
    }


    public static function factorColumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'نام', 'field' => 'name'],
            ['label' => 'عملیات', 'type'  => 'actions'],
        ]);
    }

    public static function factorRoute()
    {
        return ([
            'edit'   => 'factors.edit',
            'delete' => 'factors.destroy',
        ]);
    }

    public static function factorAction()
    {
        return ([
            'edit',
            'delete',
        ]);
    }


    public static function realFactorColumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'کد قطعه', 'field' => 'code'],
            ['label' => 'نام', 'field' => 'name'],
            ['label' => 'عملیات', 'type'  => 'actions'],
        ]);
    }

    public static function realFactorRoute()
    {
        return ([
            'show' => 'real-factor-values.show',
        ]);
    }

    public static function realFactorAction()
    {
        return ([
            'show',
        ]);
    }
}
