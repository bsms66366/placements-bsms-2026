<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicalGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinical _groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Rotation Group')->nullable();
            $table->integer('Seminar Group')->nullable();
            $table->integer('CPW')->nullable();
            $table->integer('CPS')->nullable();
            $table->integer('CPW/CPS')->nullable();
            $table->integer('Simulated Home Visit Group')->nullable();
        });

        // Table is empty - no data to insert
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinical _groups');
    }
}
