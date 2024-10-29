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
      $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
      $table->string('title')->unique();
      $table->text('overview');
      $table->enum('condition', ['new', 'used']);
      $table->string('mileage')->nullable();
      $table->string('vin')->unique();
      $table->integer('price');
      $table->enum('currency', ['rwf','usd']);
      $table->string('cover_image');
      $table->json('images');
      $table->tinyInteger('is_negotiable')->default(0);
      $table->tinyInteger('is_available')->default(0);
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
