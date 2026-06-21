<?php

namespace App\Services;

use App\Models\Part;

class CostEstimationService
{
    public function calculate(Part $part)
    {
        // -------------------------
        // محاسبه هزینه مواد
        // -------------------------

        $materialCost = 0;

        $materials = $part->partMaterials->map(function ($item) use (&$materialCost) {

            $cost = $item->quantity * $item->material->rate;

            $materialCost += $cost;

            return [
                'name' => $item->material->name,
                'quantity' => $item->quantity,
                'unit_price' => $item->material->rate,
                'cost' => $cost,
            ];

        });


        // -------------------------
        // محاسبه فرآیندها
        // -------------------------

        $processCost = 0;

        $processes = $part->partProcesses->map(function ($partProcess) use (&$processCost) {

            $process = $partProcess->process;


            // نرخ فعال فرآیند
            $rate = $process->activeRate?->rate_per_unit ?? 0;


            // هزینه پایه
            $baseCost = $partProcess->standard_quantity * $rate;


            // ضریب خطی عوامل
            $coefficient = 0;


            foreach ($partProcess->realFactorValues as $value) {

                $weight = $value
                    ->processFactor
                    ->weight;


                $realValue = $value->coefficient_value;


                $coefficient += $weight * $realValue;
            }


            // هزینه نهایی فرآیند
            $finalCost = $baseCost * $coefficient;


            $processCost += $finalCost;


            return [

                'name' => $process->name,

                'quantity' => $partProcess->standard_quantity,

                'rate' => $rate,

                'base_cost' => $baseCost,

                'coefficient' => $coefficient,

                'final_cost' => $finalCost,


                'factors' => $partProcess
                    ->realFactorValues
                    ->map(function ($value){

                        return [
                            'factor' =>
                                $value->processFactor->factor->name,

                            'weight' =>
                                $value->processFactor->weight,

                            'value' =>
                                $value->coefficient_value,

                            'result' =>
                                $value->processFactor->weight *
                                $value->coefficient_value
                        ];

                    })
            ];

        });


        return [

            'part' => $part,

            'materials' => $materials,

            'materialCost' => $materialCost,


            'processes' => $processes,

            'processCost' => $processCost,


            'totalCost' =>
                $materialCost + $processCost
        ];
    }
}











//
// namespace App\Services;
// 
// use App\Models\Part;
// 
// class CostEstimationService
// 
    // public function calculate(Part $part): array
    // {
        
        // $materialCost = $this->calculateMaterialCost($part);
// 
        // $processes = [];
        // $processCost = 0;
// 
        // foreach ($part->partProcesses as $partProcess) {
// 
            // $processResult =
                // $this->calculateProcessCost($partProcess);
// 
            // $processCost += $processResult['cost'];
// 
            // $processes[] = $processResult;
        // }
// 
        // return [
            // 'material_cost' => $materialCost,
            // 'process_cost' => $processCost,
            // 'total_cost' => $materialCost + $processCost,
            // 'processes' => $processes,
        // ];
    // }
// 
    // private function calculateMaterialCost($part): float
    // {
        // return $part->partMaterials->sum(function ($partMaterial) {
// 
            // return
                // $partMaterial->quantity
                // *
                // $partMaterial->material->rate_per_kg;
        // });
    // }
// 
    // private function calculateProcessCost($partProcess): array
    // {
        // $rate =
            // $partProcess
                // ->process
                // ->processRate
                // ->rate_per_unit;
// 
        // $baseCost =
            // $partProcess->standard_quantity
            // *
            // $rate;
// 
        // $factorResult =
            // $this->calculateFactorMultiplier($partProcess);
// 
        // $multiplier =
            // $factorResult['multiplier'];
// 
        // $finalCost =
            // $baseCost
            // *
            // $multiplier;
// 
        // return [
            // 'process_name' =>
                // $partProcess->process->name,
// 
            // 'standard_quantity' =>
                // $partProcess->standard_quantity,
// 
            // 'rate_per_unit' =>
                // $rate,
// 
            // 'base_cost' =>
                // $baseCost,
// 
            // 'multiplier' =>
                // $multiplier,
// 
            // 'cost' =>
                // $finalCost,
// 
            // 'factors' =>
                // $factorResult['factors'],
        // ];
    // }
// 
    // private function calculateFactorMultiplier($partProcess): array
    // {
        // $multiplier = 0;
// 
        // $factors = [];
// 
        // foreach ($partProcess->realFactorValues as $value) {
// 
            // $weight =
                // $value
                    // ->processFactor
                    // ->weight;
// 
            // $coefficient =
                // $value
                    // ->coefficient_value;
// 
            // $result =
                // $weight
                // *
                // $coefficient;
// 
            // $multiplier += $result;
// 
            // $factors[] = [
                // 'factor_name' =>
                    // $value
                        // ->processFactor
                        // ->factor
                        // ->name,
// 
                // 'weight' =>
                    // $weight,
// 
                // 'coefficient' =>
                    // $coefficient,
// 
                // 'result' =>
                    // $result,
            // ];
        // }
// 
        // return [
            // 'multiplier' => $multiplier,
            // 'factors' => $factors,
        // ];
    // }
