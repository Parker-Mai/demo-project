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
        Schema::create('lm_modules', function (Blueprint $table) {
            $table->id();
            $table->string('module_display_name')->nullable();
            $table->string('module_name')->nullable();
            $table->string('module_model_name');
            $table->string('module_controller_name');
            $table->Integer('category_id')->default(0);
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
        Schema::dropIfExists('lm_modules');
    }
};
