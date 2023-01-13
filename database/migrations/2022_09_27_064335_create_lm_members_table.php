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
            $table->tinyInteger('login_type')->default("0");
            $table->string('api_id')->nullable();
            $table->string('member_name')->unique()->nullable();
            $table->string('member_password')->nullable();
            $table->string('member_email')->unique();
            $table->string('member_realname');
            $table->tinyInteger('member_gender')->nullable();
            $table->string('member_phone')->nullable();
            $table->string('member_birth')->nullable();
            $table->tinyInteger('is_disabled')->default("0");
            $table->string('google_avatar')->nullable();
            $table->string('google_token')->nullable();
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
