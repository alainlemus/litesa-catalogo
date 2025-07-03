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
        Schema::create('lighting_pages', function (Blueprint $table) {
            $table->id();

            // Sección 1
            $table->string('section1_title')->nullable();
            $table->text('section1_description')->nullable();
            $table->json('section1_items')->nullable(); // cada ítem: { "text": "...", "svg": "..." }
            $table->string('section1_image_path')->nullable();

            // Sección 2
            $table->string('section2_title')->nullable();
            $table->text('section2_description')->nullable();
            $table->string('section2_image_path')->nullable();
            $table->string('section2_url')->nullable();

            // Sección 3
            $table->json('section3_images')->nullable(); // permite subir múltiples imágenes

            // SEO
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_image_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lighting_pages');
    }
};
