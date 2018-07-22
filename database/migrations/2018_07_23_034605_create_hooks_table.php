<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hooks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('path')->unique();
            $table->string('url')->nullable();
            $table->string('url_string')->nullable();
            $table->string('method');
            $table->string('ip')->nullable();
            $table->text('headers')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hooks');
    }
}
