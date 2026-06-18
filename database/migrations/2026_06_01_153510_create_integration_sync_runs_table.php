<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('integration_sync_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('integration_config_id')->constrained('integration_configs')->cascadeOnDelete();
            $table->uuid('batch_id')->unique();
            $table->string('status', 20)->default('running')->index();

            $table->dateTime('watermark_start', 6)->nullable();
            $table->dateTime('watermark_end', 6)->nullable();

            $table->unsignedInteger('pages_processed')->default(0);
            $table->unsignedInteger('pulled_count')->default(0);
            $table->unsignedInteger('staged_count')->default(0);
            $table->unsignedInteger('mapped_count')->default(0);
            $table->unsignedInteger('failed_count')->default(0);

            $table->dateTime('started_at', 6);
            $table->dateTime('finished_at', 6)->nullable();
            $table->text('error_summary')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('integration_sync_runs');
    }
};
