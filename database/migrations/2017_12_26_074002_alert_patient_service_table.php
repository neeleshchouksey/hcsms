<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertPatientServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_services', function (Blueprint $table) {
            //
            $table->integer('bg_number')->nullable()->default(180)->after('ongoing');
            $table->integer('sm_number')->nullable()->default(80)->after('ongoing');
            $table->integer('alert_low')->nullable()->default(5)->after('ongoing');
            $table->integer('alert_high')->nullable()->default(10)->after('ongoing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_services', function (Blueprint $table) {
            //
            $table->dropColumn('bg_number');
            $table->dropColumn('sm_number');
            $table->dropColumn('alert_low');
            $table->dropColumn('alert_high');
            
        });
    }
}
