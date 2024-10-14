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
    Schema::create('vehicles', function (Blueprint $table) {
      $table->id();
      $table->foreignId('make_id')->constrained('makes')->onDelete('cascade');
      $table->foreignId('model_id')->constrained('models')->onDelete('cascade');
      $table->year('year');
      $table->string('image')->nullable();
      $table->string('slug')->unique();
      $table->tinyInteger('is_featured')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('vehicles');
  }
};
