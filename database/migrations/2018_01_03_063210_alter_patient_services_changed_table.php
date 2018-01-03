<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPatientServicesChangedTable extends Migration
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
            $table->tinyInteger('ischanged')->nullable()->default(0)->after('bs_very_high_alert');
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
            $table->dropColumn('ischanged');
        });
    }
}
