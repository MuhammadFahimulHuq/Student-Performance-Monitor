<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksdistributionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marksdistribution', function (Blueprint $table) {
            $table->bigIncrements('marksDistributionID');
            $table->integer('marksObtainable');
            $table->string('assessmentType');
            $table->string('questionNo');

             #foreign key section
             $table->unsignedBigInteger('co_ID');
        
             $table->unsignedBigInteger('semester_ID');
 
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
        Schema::dropIfExists('marksdistrubution');
    }
}
