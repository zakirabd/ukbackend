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
        Schema::create('tourism_services_information', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('services_id');
            // $table->foreign('services_id')->references('id')->on('tourism_services')->onDelete('cascade');
            $table->string('email');
            $table->string('departure_time');
            $table->string('turn_time');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('where_from');
            $table->string('where_to');
            $table->string('description');
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
        Schema::dropIfExists('tourism_services_information');
    }
};
