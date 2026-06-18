<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('map_student_status', function (Blueprint $table) {
            $table->id();
            $table->string('source_system', 60)->default('sits_stutalk2');
            $table->string('sits_status_code', 40);
            $table->string('internal_status', 40)->index();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['source_system', 'sits_status_code'], 'uq_status_map');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('map_student_status');
    }
};
