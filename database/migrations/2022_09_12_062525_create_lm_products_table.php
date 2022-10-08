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
        Schema::create('lm_products', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id');
            $table->string('product_name');
            $table->Integer('product_main_category');
            $table->string('product_category')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('product_price');
            $table->string('product_img')->nullable();
            $table->longText('product_content')->nullable();
            $table->longText('product_description')->nullable();
            $table->longText('product_specification')->nullable();
            $table->tinyInteger('is_show')->nullable();
            $table->tinyInteger('is_popular')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lm_products');
    }
};
