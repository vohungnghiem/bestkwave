<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->unsignedInteger('standad');
            $table->text('link')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(1);
            $table->timestamps();
            $table->foreign('standad')->references('id')->on('standads')
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
        Schema::dropIfExists('advertisements');
    }
}
