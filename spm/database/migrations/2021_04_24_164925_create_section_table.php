<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('sectionID');
            $table->integer('sectionNo');
            
            // #foreign key section
            $table->unsignedBigInteger('employee_ID');
            $table->unsignedBigInteger('course_ID');
            $table->unsignedBigInteger('semester_ID');

            // $table->foreign('employee_ID')->references('employeeID')->on('employee')->onDelete('cascade');
            // $table->foreign('course_ID')->references('courseID')->on('course')->onDelete('cascade');
            // $table->foreign('semester_ID')->references('semesterID')->on('semester')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
