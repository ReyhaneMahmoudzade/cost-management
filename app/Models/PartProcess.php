<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartProcess extends Model
{
    protected $guarded = [];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function realFactorValues()
    {
        return $this->hasMany(RealFactorValue::class);
    }
}
