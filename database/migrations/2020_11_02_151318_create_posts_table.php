<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category');
            $table->unsignedBigInteger('type_post');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->text('caption')->nullable();
            $table->string('key')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->text('link')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('sort')->nullable();
            $table->integer('view')->nullable();
            $table->timestamps();

            $table->foreign('category')->references('id')->on('categories')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_post')->references('id')->on('type_posts')
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
        Schema::dropIfExists('posts');
    }
}
