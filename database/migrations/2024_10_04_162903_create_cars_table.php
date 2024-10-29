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
      $table->string('image')->nullable();
      $table->text('summary');
      $table->text('overview')->nullable();
      $table->json('features')->nullable();
      $table->tinyInteger('is_featured')->default(0);
      
      // Reviews
      $table->integer('reviews_count')->default(0);
      $table->decimal('average_rating', 3 , 1)->default(0);
      
      
      // Basic
      $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
      $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade');
      $table->year('year');
      
      
      // Engine Details
      $table->string('engine_type')->nullable();
      $table->string('fuel_type')->nullable();
      $table->string('horse_power')->nullable();
      $table->string('top_speed')->nullable();


      // Transmission
      $table->string('transmission_type')->nullable();
      $table->integer('number_of_gears')->nullable();
      
      // Capacity
      $table->string('fuel_tank_capacity')->nullable();
      $table->integer('number_of_seats')->nullable();

      // Measurements
      $table->string('width')->nullable();
      $table->string('height')->nullable();
      $table->string('curb_weight')->nullable();
      $table->string('payload')->nullable();


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
