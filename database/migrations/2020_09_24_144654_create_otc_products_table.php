<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtcProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otc_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('form')->nullable();
            $table->string('generic_name')->nullable();
            $table->string('pharmaceutical')->nullable();
            $table->float('price');
            $table->string('category');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('otc_products');
    }
}
