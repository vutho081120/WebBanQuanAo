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
        Schema::create('hoadonchitiet', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hoadon_id');
            $table->bigInteger('sanpham_id');
            $table->string('quantity');
            $table->string('colorSize');
            $table->double('close_price');
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
        Schema::dropIfExists('hoadonchitiet');
    }
};
