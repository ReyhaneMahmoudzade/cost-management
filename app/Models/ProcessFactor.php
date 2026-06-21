<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessFactor extends Model
{
    protected $guarded = [];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }

    public function realFactorValues()
    {
        return $this->hasMany(
            RealFactorValue::class,
            'process_factor_id'
        );
    }
}
