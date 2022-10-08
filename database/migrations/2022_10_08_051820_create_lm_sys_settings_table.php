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
        Schema::create('lm_sys_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sys_name');
            $table->string('sys_logo');
            $table->string('sys_start_date')->nullable();
            $table->string('sys_end_date')->nullable();
            $table->longText('sys_deny_ip')->nullable();

            $table->longText('sys_api_id')->nullable();
            $table->longText('sys_api_hashkey')->nullable();
            $table->longText('sys_api_hashiv')->nullable();

            $table->longText('sys_api_ctc_id')->nullable();
            $table->longText('sys_api_ctc_hashkey')->nullable();
            $table->longText('sys_api_ctc_hashiv')->nullable();
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
        Schema::dropIfExists('lm_sys_settings');
    }
};
