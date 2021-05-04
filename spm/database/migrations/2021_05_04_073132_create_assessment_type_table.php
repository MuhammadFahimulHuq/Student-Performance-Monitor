<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessmentTypes', function (Blueprint $table) {
            $table->id('assessmentTypeID');
            $table->string('assessmentType');
            $table->integer('assessmentPercentage');
            $table->unsignedBigInteger('sectionID');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessmentTypes');
    }
}
