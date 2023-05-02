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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('seller_id');
            $table->string('logo_img');
            $table->string('adress');
            $table->string('adress_qr')->nullable();
            $table->string('adress_ru')->nullable();
            $table->mediumText('description');
            $table->mediumText('description_qr')->nullable();
            $table->mediumText('description_ru')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('sellers');
    }
};
