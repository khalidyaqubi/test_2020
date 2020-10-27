<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(0);
            $table->boolean('fixing');
            $table->integer('user_id');
            $table->string('img')->nullable();
            $table->string('title_ar');
            $table->longText('details_ar');
            $table->longText('the_file_ar');
            $table->string('title_en')->nullable();
            $table->longText('details_en')->nullable();
            $table->longText('the_file_en')->nullable();
            $table->string('title_tr')->nullable();
            $table->longText('details_tr')->nullable();
            $table->longText('the_file_tr')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
