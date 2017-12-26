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
            $table->integer('sm_number')->nullable()->default(80)->after('bg_number');
            $table->integer('low_alert')->nullable()->default(5)->after('sm_number');
            $table->integer('very_low_alert')->nullable()->default(10)->after('low_alert');
            $table->integer('high_alert')->nullable()->default(5)->after('very_low_alert');
            $table->integer('very_high_alert')->nullable()->default(10)->after('high_alert');
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
