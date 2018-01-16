<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertSmsLanguagesVerifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('language_sms_messages', function (Blueprint $table) {
            //
            $table->tinyInteger('status')->after('role')->default(1);
            $table->integer('verified_by')->after('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('language_sms_messages', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->dropColumn('verified_by');
        });
    }
}
