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
    Schema::create('cars', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('slug');
      $table->text('summary');
      $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
      $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade');
      $table->year('year');
      $table->string('image')->nullable();
      $table->tinyInteger('is_featured')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('cars');
  }
};
