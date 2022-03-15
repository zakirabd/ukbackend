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
        Schema::create('insurance_services', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('country');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('date');
            $table->string('date_of_birth');
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
        Schema::dropIfExists('insurance_services');
    }
};
