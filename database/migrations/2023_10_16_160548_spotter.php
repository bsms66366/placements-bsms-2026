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
        Schema::create('Spotter', function (Blueprint $table) {
                    $table->id();
                    $table->string('email', 255)->nullable();
                    $table->text('link')->nullable();
                    //$table->string('category_id', 255)->nullable();
                    $table->timestamps();
                       $table->unsignedBigInteger('user_id')->nullable();
                                 $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                    $table->foreignId('category_id')
                               ->nullable()
                               ->constrained('categories')
                               ->onDelete('cascade');
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
};
