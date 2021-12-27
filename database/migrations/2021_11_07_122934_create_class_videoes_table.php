<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassVideoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_videoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("course_id")->constrained("courses")->onDelete("cascade")->onUpdate("cascade");
            $table->string("video_name");
            $table->string("video_path");
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
        Schema::dropIfExists('class_videoes');
    }
}
