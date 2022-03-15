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
        Schema::create('education_label_translates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('edu_label_id');
            $table->foreign('edu_label_id')->references('id')->on('education_labels')->onDelete('cascade');
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
        Schema::dropIfExists('education_label_translates');
    }
};
