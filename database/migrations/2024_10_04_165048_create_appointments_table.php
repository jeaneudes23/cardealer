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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('car_id')->nullable()->constrained('cars')->onDelete('cascade');
            $table->foreignId('sales_person_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('date');
            $table->text('customer_message')->nullable();
            $table->text('sales_person_message')->nullable();
            $table->enum('status',['pending','scheduled', 'cancelled','completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
