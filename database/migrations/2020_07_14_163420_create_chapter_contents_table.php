<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_contents', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('chapter_id');
            $table->timestamps();

            $table->foreign('chapter_id')->references('id')->on('course_chapters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapter_contents');
    }
}
