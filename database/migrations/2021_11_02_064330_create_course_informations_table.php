<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("course_id")->constrained("courses")->onDelete("cascade")->onUpdate("cascade");
            $table->string("day_name");
            $table->time("start_time");
            $table->time("end_time");
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
        Schema::dropIfExists('course_informations');
    }
}
