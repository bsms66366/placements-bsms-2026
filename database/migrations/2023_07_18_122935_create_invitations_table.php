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
        Schema::create('invitations', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string("code",45)->unique();
          $table->enum("type",['student','college', 'employee', 'general']);
          $table->string("fullname");
          $table->string("email");
          $table->string("phone")->nullable();
          $table->text("email_content")->nullable();
          $table->text("notes")->nullable();
          $table->enum("status",['Open', 'Process', 'Closed', 'Aborted'])->default("Open");
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
};
