<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cos', function (Blueprint $table) {
            $table->bigIncrements('coID');
            $table->integer('coNo');

               #foreign key section
               $table->string('courseID');
               $table->unsignedBigInteger('ploID');
           
   
            //    $table->foreign('plo_ID')->references('ploID')->on('plo')->onDelete('cascade');
            //    $table->foreign('course_ID')->references('courseID')->on('course')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cos');
    }
}
