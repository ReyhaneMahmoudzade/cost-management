<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('real_factor_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('part_process_id')->constrained('part_processes')->cascadeOnDelete();
            $table->foreignId('process_factor_id')->constrained('process_factors')->cascadeOnDelete();
            $table->float('coefficient_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_factor_values');
    }
};
