<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertSmsLanguagesTable extends Migration
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

            $table->integer('user_id')->after('language_id')->default(1);
            $table->tinyInteger('role')->after('user_id')->default(1);

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
            $table->dropColumn('role');
            $table->dropColumn('user_id');

        });
    }
}
