<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductUseProductTable extends Migration
{
    public function up()
    {
        Schema::create('product_use_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_use_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_use_id')->references('id')->on('product_uses')->onDelete('cascade');

            $table->unique(['product_id', 'product_use_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_use_product');
    }
}