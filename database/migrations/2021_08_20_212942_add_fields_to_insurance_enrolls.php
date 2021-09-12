<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToInsuranceEnrolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_enrolls', function (Blueprint $table) {
            $table->string('name')->nullable()->after('type');
            $table->string('date_of_birth')->nullable()->after('name');
            $table->string('gender')->nullable()->after('date_of_birth');
            $table->string('marital_status')->nullable()->after('gender');
            $table->string('nominee_name')->nullable()->after('marital_status');
            $table->string('nominee_number')->nullable()->after('nominee_name');
            $table->string('nominee_relation')->nullable()->after('nominee_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_enrolls', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropColumn('marital_status');
            $table->dropColumn('nominee_name');
            $table->dropColumn('nominee_number');
            $table->dropColumn('nominee_relation');
        });
    }
}
