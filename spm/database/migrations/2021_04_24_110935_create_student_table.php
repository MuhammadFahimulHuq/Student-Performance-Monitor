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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('gender');
            $table->date('dateOfBirth');
            $table->string('phone');
            $table->string('address');
            $table->date('admissionDate');
            $table->float('cgpa');

            //foreign key
            $table->string('programID');
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
