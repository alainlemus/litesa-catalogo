<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_uses', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
        });

        foreach (['posts', 'products', 'about_page_settings'] as $name) {
            Schema::table($name, function (Blueprint $table) {
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('product_uses', fn (Blueprint $t) => $t->dropColumn(['description', 'image', 'meta_title', 'meta_description']));
        foreach (['posts', 'products', 'about_page_settings'] as $name) {
            Schema::table($name, fn (Blueprint $t) => $t->dropColumn(['meta_title', 'meta_description']));
        }
    }
};
