<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function partMaterials()
    {
        return $this->hasMany(PartMaterial::class);
    }

    public function parts()
    {
        return $this->belongsToMany(
            Part::class,
            'part_materials'
        )->withPivot('quantity');
    }

    public function materialRates()
    {
        return $this->hasMany(MaterialRate::class);
    }

    public function activeRate()
    {
        return $this->hasOne(MaterialRate::class)
            ->where('is_active', 1);
    }
}
