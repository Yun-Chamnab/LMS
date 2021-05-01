<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->string('class_id');
            // $table->unsignedInteger('class_id');
            $table->foreign('class_id')
                ->references('uuid')
                ->on('classservices')
                ->onDelete('cascade');
            $table->integer('teacher_id');
            $table->string('teacher_name');
            $table->string('title');
            $table->string('description');
            $table->string('image_path')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
