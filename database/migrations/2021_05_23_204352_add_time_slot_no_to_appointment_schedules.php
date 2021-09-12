<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeSlotNoToAppointmentSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_schedules', function (Blueprint $table) {
            $table->integer('time_slot_no')->nullable();
            $table->string('time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment_schedules', function (Blueprint $table) {
            $table->dropColumn('time_slot_no');
            $table->dropColumn('time');
        });
    }
}
