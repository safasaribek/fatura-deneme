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
        Schema::create('satis_faturas', function (Blueprint $table) {
            $table->id();
            $table->string('stokadi');
            $table->string('slug')->unique();
            $table->integer('miktar');
            $table->integer('fiyat');
            $table->integer('kdv');
            $table->integer('iskonto');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satis_faturas');
    }
};
