<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksDisseminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marksDisseminations', function (Blueprint $table) {
            $table->bigIncrements('marksdisseminationsID');
            $table->integer('marksObtained');

               #foreign key section
               $table->unsignedBigInteger('studentID');
               $table->unsignedBigInteger('assessmentID');
              
   
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
        Schema::dropIfExists('marksDisseminations');
    }
}
