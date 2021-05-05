<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('studentID');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->string('gender');
            $table->date('dateOfBirth');
            $table->string('phone');
            $table->string('address');
            $table->date('admissionDate');
            $table->integer('cgpa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
