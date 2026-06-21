<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    protected $guarded = [];

    public function processFactors()
    {
        return $this->hasMany(ProcessFactor::class);
    }
}
