<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Borra el campo 'logo' si ya no lo usarás
            $table->dropColumn('logo');

            // Agrega los nuevos campos
            $table->string('logo_light')->nullable()->after('favicon');
            $table->string('logo_dark')->nullable()->after('logo_light');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['logo_light', 'logo_dark']);
            $table->string('logo')->nullable()->after('favicon');
        });
    }
};
