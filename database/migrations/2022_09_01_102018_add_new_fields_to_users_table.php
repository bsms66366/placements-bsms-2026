<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
                                  $table->string('active', 255)->nullable()->default('');
                                  $table->string('username', 255)->nullable()->default('');
                                  $table->integer('student_number')->nullable();
                                  $table->string('first_name', 255)->nullable()->default('');
                                  $table->string('known_as', 255)->nullable()->default('');
                                  $table->date('dob')->nullable();
                                  $table->string('rotation_group', 255)->nullable()->default('');
                                  $table->integer('year')->nullable();
                                  $table->string('age', 255)->nullable();
                                  $table->string('gender', 255)->nullable();
                                  $table->string('car_owner', 255)->nullable();
                                  $table->text('notes')->nullable();
                                  $table->string('gp_teacher', 255)->nullable()->default('');
                                  $table->integer('placements_id')->nullable();
                                  $table->integer('facilitator_id')->nullable();
                                  $table->integer('group_id')->nullable();
                                  $table->integer('locations_id');
                                  $table->integer('gp_teacher_id');
                                  $table->string('guid')->nullable()->default('');
                                  $table->string('domain')->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
                      $table->string('active', 255)->nullable()->default('');
                      $table->string('username', 255)->nullable()->default('');
                      $table->integer('student_number')->nullable();
                      $table->string('first_name', 255)->nullable()->default('');
                      $table->string('known_as', 255)->nullable()->default('');
                      $table->date('dob')->nullable();
                      $table->string('rotation_group', 255)->nullable()->default('');
                      $table->integer('year')->nullable();
                      $table->string('age', 255)->nullable();
                      $table->string('gender', 255)->nullable();
                      $table->string('car_owner', 255)->nullable();
                      $table->text('notes')->nullable();
                      $table->string('gp_teacher', 255)->nullable()->default('');
                      $table->integer('placements_id')->nullable();
                      $table->integer('facilitator_id')->nullable();
                      $table->integer('group_id')->nullable();
                      $table->integer('locations_id');
                      $table->integer('gp_teacher_id');
                      $table->string('guid')->nullable()->default('');
                      $table->string('domain')->nullable()->default('');
        });
    }
};
