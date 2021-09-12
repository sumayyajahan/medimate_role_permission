<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsEmergencyToAppointmentSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_schedules', function (Blueprint $table) {
            $table->boolean('is_emergency')->after('service_by')->default(false);
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
            $table->dropColumn('is_emergency');
        });
    }
}
