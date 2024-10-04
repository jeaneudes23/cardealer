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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('address');

            $table->json('hero_section_images');
            $table->string('hero_section_title');
            $table->string('hero_section_description');
            $table->string('hero_section_cta');
            $table->string('hero_section_cta_link');

            $table->string('services_section_title');

            $table->string('why_us_section_title');
            $table->text('why_us_section_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
