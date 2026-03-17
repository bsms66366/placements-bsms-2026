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
        Schema::dropIfExists('dicom'); // Drop table if exists
        Schema::create('dicom', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('urlCode', 255)->default('');
            $table->string('user_id', 255)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('dicom');
    }
};
