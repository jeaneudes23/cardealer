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
      $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
      $table->foreignId('model_id')->nullable()->constrained()->onDelete('cascade');
      $table->enum('quality', ['used', 'new'])->nullable();
      $table->year('year');
      $table->integer('price');
      $table->integer('mileage')->nullable();
      $table->string('vin')->unique();     
      $table->json('colors')->nullable();  
      $table->enum('status', ['available', 'sold', 'pending'])->default('available');
      $table->json('images');
      $table->text('description')->nullable();
      $table->tinyInteger('is_active')->default(1);
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
