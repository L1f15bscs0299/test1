<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePullLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pull_logs', function (Blueprint $table) {
            $table->id();
            $table->string('server');
            $table->string('repo');
            $table->string('branch');
            $table->string('prefix');
            $table->string('log');
            $table->string('status');
            $table->string('date_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pull_logs');
    }
}
