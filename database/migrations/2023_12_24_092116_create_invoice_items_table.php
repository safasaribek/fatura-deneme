<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained();
            $table->foreignId('invoice_id')->constrained();
//            $table->decimal('quantity', 13, 4);
            $table->decimal('quantity');
            $table->decimal('price', 13, 4);
            $table->integer('vat_rate');
            $table->decimal('vat_total');
            $table->decimal('discount_rate');
            $table->decimal('discount_total');
            $table->string('currency');
            $table->decimal('currency_rate');
            $table->decimal('total');
            $table->decimal('grand_total');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
