<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPatientServicesBsTable extends Migration
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
            $table->float('target')->nullable()->default(4.9)->after('high_alert');
            $table->integer('bs_low_alert')->nullable()->default(10)->after('target');
            $table->integer('bs_very_low_alert')->nullable()->default(20)->after('bs_low_alert');
            $table->integer('bs_high_alert')->nullable()->default(10)->after('bs_very_low_alert');
            $table->integer('bs_very_high_alert')->nullable()->default(20)->after('bs_high_alert');
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
            $table->dropColumn('target');
            $table->dropColumn('bs_low_alert');
            $table->dropColumn('bs_very_low_alert');
            $table->dropColumn('bs_high_alert');
            $table->dropColumn('bs_very_high_alert');
        });
    }
}
