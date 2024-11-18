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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sales_person_id')->constrained('users')->onDelete('cascade');
            $table->integer('sale_price');
            $table->timestamp('sale_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
