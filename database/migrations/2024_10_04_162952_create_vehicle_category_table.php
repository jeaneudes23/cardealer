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
    Schema::create('vehicle_category', function (Blueprint $table) {
      $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
      $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('vehicle_category');
  }
};
