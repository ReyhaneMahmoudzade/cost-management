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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');//نام
            $table->string('code');//کد قطعه
            $table->string('group');//گروه کالا
            $table->string('type');//ماهیت
            $table->string('weight');//وزن
            $table->string('area');//مساحت
            $table->string('perimeter');//محیط
            $table->text('description');//سایر 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
