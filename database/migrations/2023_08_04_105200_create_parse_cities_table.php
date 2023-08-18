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
        Schema::create('parse_cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parse_id');
            $table->unsignedBigInteger('city_id');
            $table->foreign('parse_id')->references('id')->on('parses');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parse_cities');
    }
};
