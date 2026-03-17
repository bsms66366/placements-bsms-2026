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
        Schema::create('nifti_files', function (Blueprint $table) {
                    $table->id();
                    $table->string('file_name');
                    $table->string('file_path');
                    $table->timestamp('upload_date')->useCurrent();
                    $table->bigInteger('file_size')->nullable();
                    $table->string('file_format', 10)->nullable();
                    $table->string('modality', 50)->nullable();
                    $table->string('patient_id', 100)->nullable();
                    $table->string('study_id', 100)->nullable();
                    $table->string('series_id', 100)->nullable();
                    $table->text('description')->nullable();
                    $table->string('orientation', 20)->nullable();
                    $table->string('voxel_dimensions', 50)->nullable();
                    $table->string('dimensions', 50)->nullable();
                    $table->string('created_by', 100)->nullable();
                    $table->json('tags')->nullable();
                    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('nifti_files');
    }
};
