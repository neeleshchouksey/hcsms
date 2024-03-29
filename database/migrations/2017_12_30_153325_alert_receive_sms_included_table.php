<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertReceiveSmsIncludedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receive_sms', function (Blueprint $table) {
            //
            $table->tinyInteger('included')->after('patient_service_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receive_sms', function (Blueprint $table) {
            //
            $table->dropColumn('included');
        });
    }
}
