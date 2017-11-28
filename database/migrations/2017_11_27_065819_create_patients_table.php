<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('ref_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('name')->nullable();
            $table->string('note')->nullable();
            $table->string('services')->nullable();
            $table->string('user_id')->nullable();
            $table->tinyInteger('agree')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
