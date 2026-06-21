<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartMaterial extends Model
{
    protected $guarded = [];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
