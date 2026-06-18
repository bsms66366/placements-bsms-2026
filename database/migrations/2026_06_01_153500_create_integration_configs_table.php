<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('integration_configs', function (Blueprint $table) {
            $table->id();
            $table->string('integration_name', 120)->unique();
            $table->string('source_system', 60)->default('sits_stutalk2')->index();
            $table->string('direction', 40)->default('export_out_of_sits');
            $table->boolean('is_active')->default(true)->index();

            $table->string('service_url', 500);
            $table->string('http_method', 10)->default('POST');
            $table->string('auth_type', 40)->default('token');
            $table->string('auth_secret_ref', 200);

            $table->string('operation_name', 120);
            $table->string('event_type', 40)->nullable();
            $table->string('rule_code', 80)->nullable();
            $table->string('monitor_type', 20)->nullable();
            $table->string('monitor_session_mode', 20)->nullable()->default('concurrent');
            $table->json('operation_params')->nullable();

            $table->boolean('incremental_enabled')->default(true);
            $table->string('watermark_param', 80)->default('updated_since');
            $table->string('watermark_field', 80)->default('updated_at');
            $table->string('watermark_store_key', 150)->nullable();
            $table->dateTime('watermark_value', 6)->nullable();
            $table->unsignedInteger('watermark_lag_seconds')->default(120);

            $table->boolean('pagination_enabled')->default(true);
            $table->string('pagination_mode', 20)->default('page');
            $table->string('pagination_param_page', 50)->nullable()->default('page');
            $table->string('pagination_param_size', 50)->nullable()->default('limit');
            $table->unsignedInteger('page_size')->default(500);
            $table->unsignedInteger('max_pages_per_run')->default(200);

            $table->boolean('retry_enabled')->default(true);
            $table->unsignedInteger('retry_max_attempts')->default(5);
            $table->string('retry_backoff_strategy', 40)->default('exponential_jitter');
            $table->unsignedInteger('retry_backoff_base_ms')->default(500);
            $table->json('retry_on_statuses')->nullable();
            $table->json('fail_on_statuses')->nullable();
            $table->unsignedInteger('request_timeout_seconds')->default(30);
            $table->unsignedInteger('connect_timeout_seconds')->default(10);

            $table->string('stage_table', 120)->default('sits_stage_students_raw');
            $table->string('publish_table', 120)->default('students');
            $table->string('dedupe_key', 80)->default('student_code');
            $table->string('upsert_mode', 60)->default('upsert_on_dedupe_key');

            $table->boolean('dlq_enabled')->default(true);
            $table->string('dlq_table', 120)->default('sits_stage_students_dlq');
            $table->boolean('metrics_enabled')->default(true);
            $table->boolean('alert_on_failure')->default(true);

            $table->string('schedule_cron', 80)->default('0 * * * *');
            $table->string('full_reconcile_cron', 80)->nullable()->default('30 2 * * *');

            $table->string('license_required', 40)->nullable()->default('MEN13_SAK');
            $table->dateTime('last_run_at', 6)->nullable();
            $table->dateTime('last_success_at', 6)->nullable();
            $table->text('last_error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('integration_configs');
    }
};
