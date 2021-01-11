<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryIdolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_idols', function (Blueprint $table) {
            $table->unsignedInteger('idol_id');
            $table->unsignedInteger('gallery_id');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->primary(['idol_id', 'gallery_id']);

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
        Schema::dropIfExists('gallery_idols');
    }
}
