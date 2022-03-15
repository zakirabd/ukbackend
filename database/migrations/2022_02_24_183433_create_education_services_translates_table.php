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
        Schema::create('education_services_translates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description', '10000');
            $table->unsignedBigInteger('education_services_id');
            $table->foreign('education_services_id')->references('id')->on('education_services')->onDelete('cascade');
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
        Schema::dropIfExists('education_services_translates');
    }
};
