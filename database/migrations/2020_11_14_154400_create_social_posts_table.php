<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_social');
            $table->unsignedBigInteger('id_post');
            $table->string('link')->nullable();
            $table->timestamps();

            $table->foreign('id_post')->references('id')->on('posts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_social')->references('id')->on('socials')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['id_social', 'id_post']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_posts');
    }
}
