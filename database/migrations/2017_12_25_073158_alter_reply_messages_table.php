<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReplyMessagesTable extends Migration
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
            $table->string('message_id')->after('original_message_id')->nullable();
            $table->string('original_body')->nullable()->change();
            $table->string('original_message_id')->nullable()->change();
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
            $table->dropColumn('message_id');
        });
    }
}
