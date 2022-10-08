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
        Schema::create('lm_member_addresses', function (Blueprint $table) {
            $table->id();
            $table->Integer('member_id');
            $table->Integer('zipcode');
            $table->string('city');
            $table->string('area');
            $table->string('address');
            $table->string('addressee');
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
        Schema::dropIfExists('lm_member_addresses');
    }
};
