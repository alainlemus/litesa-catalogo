<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_page_settings', function (Blueprint $table) {
            $table->text('about_svg')->nullable()->change();
            $table->text('mission_svg')->nullable()->change();
            $table->text('vision_svg')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('about_page_settings', function (Blueprint $table) {
            $table->string('about_svg', 255)->change();
            $table->string('mission_svg', 255)->change();
            $table->string('vision_svg', 255)->change();
        });
    }
};
