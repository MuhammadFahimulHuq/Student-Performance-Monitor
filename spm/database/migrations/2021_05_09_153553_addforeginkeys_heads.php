<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddforeginkeysHeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_of_depts', function (Blueprint $table) {
            $table->foreign('HFemployeeID')->references('FemployeeID')->on('faculties')->onDelete('cascade');
            $table->foreign('managingDepartment')->references('departmentID')->on('departments')->onDelete('cascade');
        });
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
