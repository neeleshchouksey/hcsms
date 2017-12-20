<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReminderSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reminder_sms', function (Blueprint $table) {
            //
            $table->integer('sms_type_id')->after('patient_service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reminder_sms', function (Blueprint $table) {
            //
            $table->dropColumn('sms_type_id')
        });
    }
}
