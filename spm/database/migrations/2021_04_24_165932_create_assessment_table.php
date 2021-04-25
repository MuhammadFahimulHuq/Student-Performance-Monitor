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
        Schema::create('assessment', function (Blueprint $table) {
            $table->bigIncrements('assessmentID');
            $table->integer('marksObtained');

               #foreign key section
               $table->unsignedBigInteger('student_ID');
               $table->unsignedBigInteger('marksDistribution_ID');
              
   
            //    $table->foreign('student_ID')->references('studentID')->on('employee')->onDelete('cascade');
            //    $table->foreign('marksDistribution_ID')->references('marksDistributionID')->on('marksdistribution')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessment');
    }
}
