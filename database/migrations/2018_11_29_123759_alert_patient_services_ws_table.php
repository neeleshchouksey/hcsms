<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertPatientServicesWsTable extends Migration
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
            $table->float('wtarget')->after('bs_very_high_alert')->nullable();
            $table->float('wheight')->after('wtarget')->nullable();
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
        });
    }
}
