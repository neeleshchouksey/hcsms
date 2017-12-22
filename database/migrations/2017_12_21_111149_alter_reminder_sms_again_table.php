<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReminderSmsAgainTable extends Migration
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
            $table->tinyInteger('day_id')->after('sms_type_id')->default(0);
            $table->tinyInteger('time_id')->after('day_id')->default(0);
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
            $table->dropColumn('day_id');
            $table->dropColumn('time_id');
        });
    }
}
