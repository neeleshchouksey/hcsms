<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReceiveSmsTable extends Migration
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
            $table->integer('bg_number')->after('original_message_id')->default(0);
            $table->integer('sm_number')->after('bg_number')->default(0);
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
            $table->dropColumn('bg_number');
            $table->dropColumn('sm_number');
        });
    }
}
