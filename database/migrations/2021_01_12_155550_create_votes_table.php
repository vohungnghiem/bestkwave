<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->unsignedInteger('idol_id');
            $table->unsignedInteger('user_id');
            $table->date('date_id');
            $table->integer('vote')->default(0);
            $table->integer('like')->default(0);
            $table->timestamps();
            $table->primary(['idol_id', 'user_id', 'date_id']);

            $table->foreign('idol_id')->references('id')->on('idols')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
