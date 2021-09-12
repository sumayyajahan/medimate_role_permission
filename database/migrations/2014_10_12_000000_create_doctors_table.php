<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('doctorid')->unique();
            $table->string('mobile')->nullable();
            $table->string('nid')->nullable();
            $table->string('bmdc_reg')->nullable();
            $table->string('department')->nullable();
            $table->string('degree')->nullable();
            $table->string('designation')->nullable();
            $table->string('specialization')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('police_station')->nullable();
            $table->string('post_office')->nullable();
            $table->boolean('status')->default(1);
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');
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
        Schema::dropIfExists('doctors');
    }
}
