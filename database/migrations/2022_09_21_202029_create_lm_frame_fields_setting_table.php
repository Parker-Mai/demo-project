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
        Schema::create('lm_frame_fields_setting', function (Blueprint $table) {
            $table->id();
            $table->Integer('frame_id')->nullable();
            $table->string('field_display_name');
            $table->string('field_name');
            $table->tinyInteger('field_type');
            $table->longText('field_option')->default("");
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
        Schema::dropIfExists('lm_frame_fields_setting');
    }
};
