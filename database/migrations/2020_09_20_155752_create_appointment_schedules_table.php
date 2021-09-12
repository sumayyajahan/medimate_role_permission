<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('appointment_slot_id');
            $table->date('date');
            $table->date('reschedule_date')->nullable();
            $table->unsignedBigInteger('reschedule_slot_id')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('consult')->default(0);
            $table->tinyInteger('reschedule')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('appointment_slot_id')->references('id')->on('appointment_slots')->onDelete('cascade');
            $table->foreign('reschedule_slot_id')->references('id')->on('appointment_slots')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reschedule -> 0 -> Not requested for Rescheduled
     *
     * Reschedule -> 10 -> Requested for Rescheduled to a particular Date & Time
     * Reschedule -> 11 -> Reschedule to a New Date Accepted
     *
     * Reschedule -> 20 -> Requested for Cancel the Appointment
     * Reschedule -> 21 -> Requested for Canceling the Appointment ACCEPTED
     *
     * Reschedule -> 30 -> USER Deny the reschedule & Cancel the Appointment
     *
     * If the user need the appointment rather than the doctor's preferable time slot OR
     *      Need Another doctor, Admin will set the Appointment on behalf of USER from admin Panel (Reschedule Code - 30)
     *
     */

     
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_schedules');
    }
}
