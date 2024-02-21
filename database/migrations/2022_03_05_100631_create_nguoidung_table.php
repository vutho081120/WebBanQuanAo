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
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('password');
            $table->string('gender');
            $table->string('email');
            $table->date('birthday');
            $table->string('user_name');
            $table->bigInteger('tinh_id');
            $table->bigInteger('huyen_id');
            $table->bigInteger('phuong_id');
            $table->string('address');
            $table->integer('role');
            $table->rememberToken();
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
        Schema::dropIfExists('nguoidung');
    }
};
