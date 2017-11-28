<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('company');
            $table->string('contact');
            $table->integer('practice_id');
            $table->text('address');
            $table->float('monthly_fee', 8, 2)->default(100);
            $table->float('sms_send_fee', 8, 2)->default(0.05);
            $table->float('sms_reply_fee', 8, 2)->default(0.02);
            $table->float('per_patient_fee', 8, 2)->default(0.02);
            $table->float('pay_user_fee', 8, 2)->default(2.50);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
