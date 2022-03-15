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
        Schema::create('about_translates', function (Blueprint $table) {
            $table->id();
            $table->string('description', '10000');
            $table->unsignedBigInteger('about_id');
            $table->foreign('about_id')->references('id')->on('abouts')->onDelete('cascade');
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
        Schema::dropIfExists('about_translates');
    }
};
