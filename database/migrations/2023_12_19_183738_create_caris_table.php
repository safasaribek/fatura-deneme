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
        Schema::create('caris', function (Blueprint $table) {
            $table->id();
            $table->string('adi');
            $table->string('soyadi');
            $table->string('email');
            $table->string('slug')->unique();
            $table->integer('kimlikno')->unique();
            $table->integer('vergino')->unique();
            $table->integer('telefon');
            $table->string('adres');
            $table->integer('ulke');
            $table->integer('il');
            $table->integer('ilce');
            $table->integer('caritipi');
            $table->integer('bakiye')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caris');
    }
};
