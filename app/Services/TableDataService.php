<?php

namespace App\Services;

// use App\Models\Product;

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
            // ['label' => 'عملیات', 'type'  => 'actions'],
            // [
            //     'label' => 'وضعیت',
            //     'value' => function ($row) {
            //         return $row->is_active ? 'فعال' : 'غیرفعال';
            //     },
            // ],
        ]);
    }
    public static function partRoute()
    {
        return([

        ]);
    }
    public static function partAction()
    {
        return([

        ]);
    }
// $actions = ['show', 'edit', 'delete'];

        // نام روت‌ها
        // $routes = [
        //     'show'   => 'materials.show',
        //     'edit'   => 'materials.edit',
        //     'delete' => 'materials.destroy',
        // ];

    public static function materialColumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'نام', 'field' => 'name'],
            ['label' => 'ضخامت', 'field' => 'width'],
            ['label' => 'واحد', 'field' => 'unit'],
            ['label' => 'نرخ', 'field' => 'rate'],
            // ['label' => 'عملیات', 'type'  => 'actions'],
            // [
            //     'label' => 'وضعیت',
            //     'value' => function ($row) {
            //         return $row->is_active ? 'فعال' : 'غیرفعال';
            //     },
            // ],
        ]);
    }
    public static function materialRoute()
    {
        return([

        ]);
    }
    public static function materialAction()
    {
        return([
            
        ]);
    }


    public static function processCcolumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'نام', 'field' => 'name'],
            ['label' => 'واحد استاندارد', 'field' => 'standard_unit'],
            // ['label' => 'تعداد عوامل موثر', 'field' => ''],
            // ['label' => 'نرخ', 'field' => ''],
            // ['label' => 'عملیات', 'type'  => 'actions'],
            // [
            //     'label' => 'وضعیت',
            //     'value' => function ($row) {
            //         return $row->is_active ? 'فعال' : 'غیرفعال';
            //     },
            // ],
        ]);
    }
    public static function processRoute()
    {
        return([
            // 'show' => '',

        ]);
    }
    public static function processAction()
    {
        return([
            
        ]);
    }


    public static function factorCcolumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'نام', 'field' => 'name'],
            // ['label' => 'عملیات', 'type'  => 'actions'],
            // [
            //     'label' => 'وضعیت',
            //     'value' => function ($row) {
            //         return $row->is_active ? 'فعال' : 'غیرفعال';
            //     },
            // ],
        ]);
    }
    public static function factorRoute()
    {
        return([

        ]);
    }
    public static function factorAction()
    {
        return([
            
        ]);
    }


    public static function realFactorColumn()
    {
        return ([
            ['label' => 'ردیف', 'type'  => 'index'],
            ['label' => 'کد قطعه', 'field' => 'code'],
            ['label' => 'نام', 'field' => 'name'],
            ['label' => 'عملیات', 'type'  => 'actions'],
            // [
            //     'label' => 'وضعیت',
            //     'value' => function ($row) {
            //         return $row->is_active ? 'فعال' : 'غیرفعال';
            //     },
            // ],
        ]);
    }
    public static function realFactorRoute()
    {
        return([
            'show' => 'real-factor-values.show'
        ]);
    }
    public static function realFactorAction()
    {
        return([
            'show',
        ]);
    }


}
