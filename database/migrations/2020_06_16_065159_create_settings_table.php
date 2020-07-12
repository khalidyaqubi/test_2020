<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->string('img_media')->nullable();
            $table->string('video')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('our_object_ar')->nullable();
            $table->string('our_mission_ar')->nullable();
            $table->string('our_active_ar')->nullable();
            $table->string('who_are_we_ar')->nullable();
            $table->string('our_vision_tilte_ar')->nullable();
            $table->string('our_vision_quotes_ar')->nullable();
            $table->string('our_vision_content_ar')->nullable();

            $table->string('our_object_en')->nullable();
            $table->string('our_mission_en')->nullable();
            $table->string('our_active_en')->nullable();
            $table->string('who_are_we_en')->nullable();
            $table->string('our_vision_tilte_en')->nullable();
            $table->string('our_vision_quotes_en')->nullable();
            $table->string('our_vision_content_en')->nullable();

            $table->string('our_object_tr')->nullable();
            $table->string('our_mission_tr')->nullable();
            $table->string('our_active_tr')->nullable();
            $table->string('who_are_we_tr')->nullable();
            $table->string('our_vision_tilte_tr')->nullable();
            $table->string('our_vision_quotes_tr')->nullable();
            $table->string('our_vision_content_tr')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
