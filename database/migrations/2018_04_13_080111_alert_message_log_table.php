<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertMessageLogTable extends Migration
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
            $table->float('message_cost',8,2)->after('message_id')->nullable();
            $table->float('message_fee',8,2)->after('message_cost')->nullable();
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
            $table->dropColumn('message_cost');
            $table->dropColumn('message_fee');
            
        });
    }
}
