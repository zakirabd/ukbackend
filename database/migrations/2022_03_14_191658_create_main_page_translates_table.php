<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainPageTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_page_translate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_page_id');
            $table->foreign('main_page_id')->references('id')->on('main_page')->onDelete('cascade');
            $table->string('title');
            $table->string('lang_id')->default('1');
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
        Schema::dropIfExists('main_page_translates');
    }
}
