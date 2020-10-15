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
            $table->string('lang')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('address_tr')->nullable();
            $table->string('address_en')->nullable();
            $table->longText('footer_ar')->nullable();
            $table->longText('footer_en')->nullable();
            $table->longText('footer_tr')->nullable();
            $table->string('about_us_img')->nullable();
            $table->string('about_us_img2')->nullable();
            $table->string('media_img')->nullable();
            $table->string('our_vision_img')->nullable();
            $table->string('icon_img')->nullable();
            $table->string('page_img')->nullable();
            $table->string('main_img')->nullable();
            $table->string('donate_img')->nullable();
            $table->string('main_video')->nullable();
            $table->string('about_us_video')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->longText('our_object_ar')->nullable();
            $table->longText('our_mission_ar')->nullable();
            $table->longText('our_active_ar')->nullable();
            $table->longText('who_are_we_ar')->nullable();
            $table->longText('our_vision_tilte_ar')->nullable();
            $table->longText('our_vision_quotes_ar')->nullable();
            $table->longText('our_vision_content_ar')->nullable();

            $table->longText('our_object_en')->nullable();
            $table->longText('our_mission_en')->nullable();
            $table->longText('our_active_en')->nullable();
            $table->longText('who_are_we_en')->nullable();
            $table->longText('our_vision_tilte_en')->nullable();
            $table->longText('our_vision_quotes_en')->nullable();
            $table->longText('our_vision_content_en')->nullable();

            $table->longText('our_object_tr')->nullable();
            $table->longText('our_mission_tr')->nullable();
            $table->longText('our_active_tr')->nullable();
            $table->longText('who_are_we_tr')->nullable();
            $table->longText('our_vision_tilte_tr')->nullable();
            $table->longText('our_vision_quotes_tr')->nullable();
            $table->longText('our_vision_content_tr')->nullable();
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
