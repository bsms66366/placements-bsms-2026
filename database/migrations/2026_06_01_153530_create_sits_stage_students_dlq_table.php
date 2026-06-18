<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sits_stage_students_dlq', function (Blueprint $table) {
            $table->id();
            $table->foreignId('integration_config_id')->constrained('integration_configs')->cascadeOnDelete();
            $table->uuid('batch_id')->index();
            $table->foreignId('stage_row_id')->nullable()->constrained('sits_stage_students_raw')->nullOnDelete();

            $table->string('dedupe_key_value', 120)->nullable();
            $table->string('error_code', 80)->nullable();
            $table->text('error_message');

            $table->json('payload_json');
            $table->unsignedInteger('retry_count')->default(0);
            $table->dateTime('next_retry_at', 6)->nullable()->index();
            $table->dateTime('resolved_at', 6)->nullable()->index();
            $table->text('resolution_note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sits_stage_students_dlq');
    }
};
