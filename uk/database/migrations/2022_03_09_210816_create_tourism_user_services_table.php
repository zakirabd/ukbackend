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
        Schema::create('tourism_user_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_tourism_id');
            $table->foreign('user_tourism_id')->references('id')->on('tourism_services_information')->onDelete('cascade');
            $table->unsignedBigInteger('services_id');
            $table->foreign('services_id')->references('id')->on('tourism_services')->onDelete('cascade');
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
        Schema::dropIfExists('tourism_user_services');
    }
};
