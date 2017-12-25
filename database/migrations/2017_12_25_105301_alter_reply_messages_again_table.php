<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReplyMessagesAgainTable extends Migration
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
            $table->integer('patient_service_id')->after('message_id')->nullable();
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
            $table->dropColumn('patient_service_id');
        });
    }
}
