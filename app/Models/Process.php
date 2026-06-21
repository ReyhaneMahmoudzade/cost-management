<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $guarded = [];

    public function partProcesses()
    {
        return $this->hasMany(PartProcess::class);
    }

    public function parts()
    {
        return $this->belongsToMany(
            Part::class,
            'part_processes'
        )->withPivot('standard_quantity');
    }

    public function processRates()
    {
        return $this->hasMany(ProcessRate::class);
    }

    public function activeRate()
    {
        return $this->hasOne(ProcessRate::class)
            ->where('is_active', 1);
    }

    public function processFactors()
    {
        return $this->hasMany(ProcessFactor::class);
    }

    // public function fc()
    // {
    //     return $this->belongsToMany(Factor::class, 'process_factors')->withPivot('weight');
    // }
}
