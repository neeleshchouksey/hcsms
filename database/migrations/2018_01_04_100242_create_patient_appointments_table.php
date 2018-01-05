<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('appt_date')->nullable();
            $table->string('appt_time')->nullable();
            $table->string('location')->nullable();
            $table->string('with')->nullable();
            $table->tinyInteger('map_link')->nullable();
            $table->string('patient_code')->nullable();
            $table->string('location_code')->nullable();
            $table->string('reminders')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('service_id')->nullable();
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
        Schema::dropIfExists('patient_appointments');
    }
}
