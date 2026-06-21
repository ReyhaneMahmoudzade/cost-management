<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $guarded = [];

    public function partMaterials()
    {
        return $this->hasMany(PartMaterial::class);
    }

    public function materials()
    {
        return $this->belongsToMany(
            Material::class,
            'part_materials'
        )->withPivot('quantity');
    }

    public function partProcesses()
    {
        return $this->hasMany(PartProcess::class);
    }

    public function processes()
    {
        return $this->belongsToMany(
            Process::class,
            'part_processes'
        )->withPivot('standard_quantity');
    }
}
