<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->json('values')->nullable();
            $table->json('steps')->nullable();
            $table->json('sectors')->nullable();
            $table->json('reasons')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_text')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services_page_settings');
    }
};
