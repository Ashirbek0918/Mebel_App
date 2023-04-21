<?php

use App\Models\Seller;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz');
            $table->string('name_qr');
            $table->string('name_ru');
            $table->string('title_img');
            $table->double('first_price');
            $table->double('discount')->nullable();
            $table->double('second_price')->nullable();
            $table->foreignIdFor(Seller::class);
            $table->mediumText('description_uz');
            $table->mediumText('description_qr');
            $table->mediumText('description_ru');
            $table->json('images_url');
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
        Schema::dropIfExists('products');
    }
};
