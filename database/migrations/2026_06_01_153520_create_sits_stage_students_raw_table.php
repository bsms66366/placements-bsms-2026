<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sits_stage_students_raw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('integration_config_id')->constrained('integration_configs')->cascadeOnDelete();
            $table->uuid('batch_id')->index();

            $table->string('source_record_id', 120)->nullable();
            $table->string('dedupe_key_value', 120)->nullable()->index();
            $table->dateTime('source_updated_at', 6)->nullable()->index();

            $table->json('payload_json');
            $table->char('payload_sha256', 64);

            $table->string('mapping_status', 20)->default('pending')->index();
            $table->text('mapping_error')->nullable();
            $table->dateTime('processed_at', 6)->nullable();
            $table->dateTime('received_at', 6);

            $table->timestamps();

            $table->unique(['batch_id', 'payload_sha256'], 'uq_stage_batch_hash');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sits_stage_students_raw');
    }
};
