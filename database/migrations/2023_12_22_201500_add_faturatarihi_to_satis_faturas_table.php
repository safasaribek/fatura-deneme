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
        Schema::table('satis_faturas', function (Blueprint $table) {
            $table->dateTime('faturatarihi')->nullable();
            $table->dateTime('sontarih')->nullable();
            $table->integer('odemeyontemi');
            $table->string('parabirimi');
            $table->integer('kur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('satis_faturas', function (Blueprint $table) {
            //
        });
    }
};
