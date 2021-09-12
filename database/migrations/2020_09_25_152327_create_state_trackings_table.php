<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('state_trackings')->insert([
            ['name' => 'Waiting for Pharmacy Accept'],
            ['name' => 'Pharmacy Processing your Order'],
            ['name' => 'Pharmacy Shipped your Order'],
            ['name' => 'Order Delivered'],
            ['name' => 'Order Canceled by Pharmacy'],
            ['name' => 'Order Canceled by User'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_trakings');
    }
}
