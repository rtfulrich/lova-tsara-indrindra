<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('level', ['easy', 'average', 'hard'])->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('use_group_chapters')->default(true);
            $table->enum('category', ['formation', 'tutorial', 'practice'])->default('practice');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('author');
            
            $table->string('slug');
            $table->timestamps();

            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
