<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiveSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_sms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sms_time');
            $table->string('to');
            $table->string('from');
            $table->string('body');
            $table->string('original_body');
            $table->string('original_message_id');
            $table->string('custom_string')->nullable();
            $table->string('user_id')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receive_sms');
    }
}
