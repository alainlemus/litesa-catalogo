<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_image')->nullable(); // Imagen principal
            $table->text('hero_text')->nullable();

            $table->text('section1_text')->nullable();

            $table->text('section2_text')->nullable();
            $table->string('section2_image')->nullable();

            $table->text('section3_text')->nullable();

            // ¿Quiénes somos?
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_svg')->nullable();

            $table->string('mission_title')->nullable();
            $table->text('mission_description')->nullable();
            $table->string('mission_svg')->nullable();

            $table->string('vision_title')->nullable();
            $table->text('vision_description')->nullable();
            $table->string('vision_svg')->nullable();

            // Servicios
            $table->json('services')->nullable(); // Arreglo con svg, título, descripción, url

            // Testimonios
            $table->string('testimonials_title')->nullable();
            $table->text('testimonials_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_page_settings');
    }
};
