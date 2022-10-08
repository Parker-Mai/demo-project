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
        Schema::create('lm_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_uid');
            $table->Integer('member_id');
            $table->tinyInteger('payment_method');
            $table->Integer('local_number')->nullable();
            $table->string('contact_phone');
            $table->tinyInteger('order_address')->nullable();
            $table->Integer('shipping');
            $table->Integer('order_total');
            $table->tinyInteger('status')->default('0');

            $table->string('api_trade_uid')->nullable();
            $table->string('api_payment_no')->nullable();

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
        Schema::dropIfExists('lm_orders');
    }
};
