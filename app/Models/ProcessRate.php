<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessRate extends Model
{
    protected $guarded = [];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
