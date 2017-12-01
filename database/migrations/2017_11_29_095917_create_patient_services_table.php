<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('period')->nullable();
            $table->string('duration')->nullable();
            $table->timestamp('start_date')->nullable();
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
        Schema::dropIfExists('patient_services');
    }
}
