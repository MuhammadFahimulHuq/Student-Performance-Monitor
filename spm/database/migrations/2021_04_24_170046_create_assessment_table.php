<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->bigIncrements('assessmentID');
            $table->integer('marksObtainable');

            $table->integer('questionNo');

             #foreign key section
             $table->unsignedBigInteger('coID');
                $table->unsignedBigInteger('assessmentTypeID');


            //  $table->foreign('col_ID')->references('colID')->on('co')->onDelete('cascade');

            //  $table->foreign('semester_ID')->references('semesterID')->on('semester')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}
