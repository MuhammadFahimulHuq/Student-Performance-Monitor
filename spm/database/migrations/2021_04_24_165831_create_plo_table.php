<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plo', function (Blueprint $table) {
            $table->bigIncrements('ploID');
            $table->integer('ploNo');
            $table->string('details');


               #foreign key section
               $table->unsignedBigInteger('program_ID');
              
   
            //    $table->foreign('program_ID')->references('programID')->on('program')->onDelete('cascade');
             

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plo');
    }
}
