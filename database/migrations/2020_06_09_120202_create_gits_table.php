<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gits', function (Blueprint $table) {
            $table->id();
            $table->string('repo_url');
            $table->string('repo_branch');
            $table->string('prefix')->nullable();
            $table->string('secret_token')->unique();
            $table->string('server_name');
            $table->string('server_path');
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
        Schema::dropIfExists('gits');
    }
}
