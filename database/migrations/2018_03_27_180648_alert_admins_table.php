<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
            $table->renameColumn('name', 'first_name');
            $table->string('last_name',255)->after('name')->nullable();
            $table->string('mobile',255)->after('password')->nullable();
            $table->string('job_title',255)->after('mobile')->nullable();
            $table->integer('added_by')->after('job_title')->nullable();
            $table->tinyInteger('status')->after('added_by')->nullable();
            $table->text('notes')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
}
