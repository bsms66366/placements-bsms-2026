<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'source_system')) {
                $table->string('source_system', 60)->nullable()->after('id');
            }

            if (!Schema::hasColumn('students', 'external_id')) {
                $table->string('external_id', 120)->nullable()->after('source_system');
            }

            if (!Schema::hasColumn('students', 'source_updated_at')) {
                $table->dateTime('source_updated_at', 6)->nullable()->after('external_id');
            }

            if (!Schema::hasColumn('students', 'last_seen_in_source_at')) {
                $table->dateTime('last_seen_in_source_at', 6)->nullable()->after('source_updated_at');
            }

            if (!Schema::hasColumn('students', 'sync_hash')) {
                $table->char('sync_hash', 64)->nullable()->after('last_seen_in_source_at');
            }
        });

        Schema::table('students', function (Blueprint $table) {
            $table->unique(['source_system', 'external_id'], 'uq_students_source_external');
            $table->index('source_updated_at', 'idx_students_source_updated');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique('uq_students_source_external');
            $table->dropIndex('idx_students_source_updated');

            if (Schema::hasColumn('students', 'sync_hash')) {
                $table->dropColumn('sync_hash');
            }

            if (Schema::hasColumn('students', 'last_seen_in_source_at')) {
                $table->dropColumn('last_seen_in_source_at');
            }

            if (Schema::hasColumn('students', 'source_updated_at')) {
                $table->dropColumn('source_updated_at');
            }

            if (Schema::hasColumn('students', 'external_id')) {
                $table->dropColumn('external_id');
            }

            if (Schema::hasColumn('students', 'source_system')) {
                $table->dropColumn('source_system');
            }
        });
    }
};
