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
        Schema::create('lm_sitemap_frames', function (Blueprint $table) {
            $table->id();
            $table->string('frame_display_name');
            $table->string('frame_name');
            $table->tinyInteger('is_external_link')->default(0);
            $table->string('link_url')->nullable();
            $table->tinyInteger('frame_type')->default(0);
            $table->Integer('type_content_layout_id')->nullable();
            $table->Integer('type_list_layout_id')->nullable();
            $table->tinyInteger('use_module_model')->default(0);
            $table->Integer('module_id')->nullable();
            $table->tinyInteger('is_index')->default(0);
            $table->tinyInteger('is_disabled')->default(0);
            $table->Integer('parent_frame_id')->default(0);
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
        Schema::dropIfExists('lm_sitemap_frames');
    }
};
