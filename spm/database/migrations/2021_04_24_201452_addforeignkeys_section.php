<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddforeignkeysSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
  
            $table->foreign('employee_ID')->references('employeeID')->on('employees')->onDelete('cascade');
            $table->foreign('course_ID')->references('courseID')->on('courses')->onDelete('cascade');
            $table->foreign('semester_ID')->references('semesterID')->on('semesters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
