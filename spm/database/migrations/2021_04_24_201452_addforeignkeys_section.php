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
        Schema::table('section', function (Blueprint $table) {
  
            $table->foreign('employee_ID')->references('employeeID')->on('employee')->onDelete('cascade');
            $table->foreign('course_ID')->references('courseID')->on('course')->onDelete('cascade');
            $table->foreign('semester_ID')->references('semesterID')->on('semester')->onDelete('cascade');
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
