<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsCostChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_cost_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country',255)->nullable();
            $table->string('country_code',10)->nullable();
            $table->float('cost', 8, 2)->nullable();
            $table->tinyInteger('currency')->nullable();
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
        Schema::dropIfExists('sms_cost_charges');
    }
}
