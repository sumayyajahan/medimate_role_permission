<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNidPhotoToInsuranceEnrolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_enrolls', function (Blueprint $table) {
            $table->string('nid_no')->after('nominee_relation')->nullable();
            $table->string('nid_front')->after('nid_no')->nullable();
            $table->string('nid_back')->after('nid_front')->nullable();
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
            $table->dropColumn('nid_no');
            $table->dropColumn('nid_front');
            $table->dropColumn('nid_back');
        });
    }
}
