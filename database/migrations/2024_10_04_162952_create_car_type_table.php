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
    Schema::create('car_type', function (Blueprint $table) {
      $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
      $table->foreignId('type_id')->constrained('types')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('car_type');
  }
};
