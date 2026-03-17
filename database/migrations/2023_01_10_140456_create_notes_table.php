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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('administrator', 255)->nullable();
            $table->string('urlCode', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('video', 255)->nullable();
            //$table->unsignedBigInteger('category_id');
            $table->timestamps();
            //$table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreignId('category_id')
            ->nullable()
            ->constrained('category')
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
        Schema::dropIfExists('notes');
    }
};
