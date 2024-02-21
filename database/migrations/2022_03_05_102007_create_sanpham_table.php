<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('product_name');
            $table->string('product_img');
            $table->double('price');
            $table->double('sale_price')->default(0);
            $table->string('white');
            $table->string('black');
            $table->string('blue');
            $table->string('yellow');
            $table->double('amount');
            $table->double('sold')->default(0);
            $table->string('material');
            $table->string('style');
            $table->string('season');
            $table->string('brand');
            $table->string('suppiler');
            $table->string('made_in');
            $table->string('description');
            $table->string('danhmuc_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanpham');
    }
};
