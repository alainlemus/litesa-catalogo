<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeProductFieldsNullable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('warranty')->nullable()->change();
            $table->string('power_factor')->nullable()->change();
            $table->string('base')->nullable()->change();
            $table->string('certification')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('warranty')->nullable(false)->change();
            $table->string('power_factor')->nullable(false)->change();
            $table->string('base')->nullable(false)->change();
            $table->string('certification')->nullable(false)->change();
        });
    }
}
