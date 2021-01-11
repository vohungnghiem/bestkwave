<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idols', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar')->nullable();
            $table->string('nickname')->nullable();
            $table->string('name')->nullable();
            $table->unsignedInteger('agency_id')->nullable();
            $table->string('agency_name')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->string('group_name')->nullable();
            $table->unsignedInteger('profession_id')->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedInteger('gender_id')->nullable();
            $table->string('nature')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sort')->default(1);
            $table->timestamps();

            $table->foreign('agency_id')->references('id')->on('agencys')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('group_idols')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('professions')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')
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
        Schema::dropIfExists('idols');
    }
}
