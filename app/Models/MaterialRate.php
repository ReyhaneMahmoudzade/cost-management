<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialRate extends Model
{
    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
