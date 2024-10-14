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
    Schema::create('listings', function (Blueprint $table) {
      $table->id();
      $table->string('title')->unique();
      $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
      $table->enum('quality', ['new', 'used']);
      $table->integer('mileage')->nullable();
      $table->string('vin')->unique();
      $table->integer('price');
      $table->json('colors');
      $table->integer('quanity')->default(1);
      $table->tinyInteger('negotiable')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('listings');
  }
};
