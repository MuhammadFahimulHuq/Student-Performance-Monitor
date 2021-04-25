<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddforeignkeysRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('register', function (Blueprint $table) {
            $table->foreign('student_ID')->references('studentID')->on('student')->onDelete('cascade');
             $table->foreign('section_ID')->references('sectionID')->on('section')->onDelete('cascade');  
             $table->foreign('semester_ID')->references('semesterID')->on('semester')->onDelete('cascade');  }); 
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
