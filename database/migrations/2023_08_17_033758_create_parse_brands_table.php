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
        Schema::create('parse_brands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parse_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('parse_id')->references('id')->on('parses');
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parse_brands');
    }
};
