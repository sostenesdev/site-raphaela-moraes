<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content_preview')->nullable();
            $table->longText('content')->nullable();
            $table->text('image')->nullable();
            $table->text('thumbnail')->nullable();
            $table->integer('status')->default(0);
            $table->boolean('highlighted')->default(false);
            $table->boolean('is_projeto')->default(false);
            $table->foreignId('user_id')->constrained()->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('category_post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->on('categories');
            $table->foreignId('post_id')->constrained()->on('posts');
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
};
