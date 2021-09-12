<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pharmacy_id');
            $table->unsignedBigInteger('e_prescription_id')->nullable();
            $table->string('prescription_product_name')->nullable();
            $table->string('prescription_product_quantity')->nullable();
            $table->string('otc_product_id')->nullable();
            $table->string('otc_product_quantity')->nullable();
            $table->unsignedBigInteger('state_tracking_id')->default(1);
            $table->string('delivery_address');
            $table->string('payment_method')->nullable();
            $table->float('amount')->nullable();
            $table->boolean('is_accept_user')->default(0);
            $table->boolean('is_order')->default(1);
            $table->boolean('is_complete')->default(0);
            $table->string('comment')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->foreign('e_prescription_id')->references('id')->on('e_prescriptions')->onDelete('cascade');
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
        Schema::dropIfExists('user_orders');
    }
}
