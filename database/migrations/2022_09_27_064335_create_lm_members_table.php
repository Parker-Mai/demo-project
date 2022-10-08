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
        Schema::create('lm_members', function (Blueprint $table) {
            $table->id();
            $table->string('member_name')->unique();
            $table->string('member_password');
            $table->string('member_email')->unique();
            $table->string('member_realname');
            $table->tinyInteger('member_gender')->nullable();
            $table->string('member_phone');
            $table->string('member_birth')->nullable();
            $table->tinyInteger('is_disabled')->default("0");
            $table->rememberToken();
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
        Schema::dropIfExists('lm_members');
    }
};
