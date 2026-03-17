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
        Schema::table('nifti_files', function (Blueprint $table) {
                       //$table->string('directory_name', 255)->nullable();
                       //$table->string('urlCode', 255)->nullable();
                      //$table->string('nifti_files', 255)->nullable();
                       //$table->timestamp('updated_at')->nullable();
                       //$table->timestamp('created_at')->nullable();
                       
                       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                       //Schema::dropIfExists('nifti_files');
        }
    
};
