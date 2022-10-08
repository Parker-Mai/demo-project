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
        Schema::create('lm_accounts', function (Blueprint $table) {
            $table->id();
            $table->Integer('account_role')->nullable();
            $table->string('account_name')->unique();
            $table->string('account_password');
            $table->string('account_realname');
            $table->string('account_email');
            $table->string('account_phone')->nullable();
            $table->string('account_cellphone')->nullable();
            $table->string('account_photo')->nullable();
            $table->tinyInteger('account_disabled')->default('0');
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
        Schema::dropIfExists('lm_accounts');
    }
};
