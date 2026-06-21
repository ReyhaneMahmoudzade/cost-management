<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealFactorValue extends Model
{
    protected $guarded = [];    

    public function partProcess()
    {
        return $this->belongsTo(PartProcess::class);
    }

    public function processFactor()
    {
        return $this->belongsTo(ProcessFactor::class);
    }
}
