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
      $table->text('overview')->nullable();
      $table->string('image')->nullable();
      $table->tinyInteger('is_featured')->default(0);
      $table->decimal('average_rating', 3 , 1)->default(0);
      $table->integer('reviews_count')->default(0);
      
      
      // Specs
      $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
      $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade');
      $table->year('year');
      $table->string('engine_type')->nullable();
      $table->string('horse_power')->nullable();
      $table->string('top_speed')->nullable();
      $table->string('transmission')->nullable();
      $table->string('fuel_type')->nullable();
      $table->integer('number_of_seats')->nullable();
      $table->json('features')->nullable();

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
