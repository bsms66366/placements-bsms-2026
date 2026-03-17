<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('app_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('bsms_id');
            $table->string('student_name')->nullable();
            $table->string('email')->nullable();
            $table->string('feedback_type')->default('general');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->integer('rating')->nullable();
            $table->string('app_version')->nullable();
            $table->string('device_info')->nullable();
            $table->timestamps();
            
            $table->index('bsms_id');
            $table->index('feedback_type');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_feedback');
    }
};
