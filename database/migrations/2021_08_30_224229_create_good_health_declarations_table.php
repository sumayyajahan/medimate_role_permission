<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodHealthDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_health_declarations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('enroll_id')->unsigned();
            $table->string('employer_name')->nullable();
            $table->string('policy_holder_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('pf_no')->nullable();
            $table->string('current_address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('sex')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('no_children')->nullable();
            $table->string('mobile_no')->nullable();
            $table->text('dependents')->nullable();
            $table->string('coverage_for')->nullable();
            $table->string('maternity_benefit')->nullable();
            $table->string('twelve_a')->nullable();
            $table->string('twelve_b')->nullable();
            $table->string('twelve_c')->nullable();
            $table->string('twelve_d')->nullable();
            $table->string('twelve_e')->nullable();
            $table->string('twelve_f')->nullable();
            $table->text('thirteen_a')->nullable();
            $table->text('thirteen_b')->nullable();
            $table->text('thirteen_c')->nullable();
            $table->text('thirteen_d')->nullable();
            $table->text('thirteen_e')->nullable();
            $table->text('thirteen_f')->nullable();
            $table->string('signature')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('good_health_declarations');
    }
}
