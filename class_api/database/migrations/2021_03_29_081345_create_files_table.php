<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filestores', function (Blueprint $table) {
            $table->id();
            $table->string('lesson_uuid');
            $table->foreign('lesson_uuid')
                ->references('uuid')
                ->on('lessons')
                ->onDelete('cascade');
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('filestores');
    }
}
