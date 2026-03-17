<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateExaminationResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_results', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('examination_id');
            $table->string('bsms_id', 255);
            $table->boolean('is_competent')->default(0);
            $table->dateTime('assessed_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            
            // Indexes
            $table->index(['bsms_id', 'examination_id', 'id'], 'idx_exam_results_lookup');
            $table->index('examination_id', 'idx_exam_id');
            
            // Foreign key
            $table->foreign('examination_id', 'fk_exam_results_examination')
                  ->references('id')
                  ->on('examinations')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Insert data
        DB::table('examination_results')->insert([
            ['id' => 1, 'examination_id' => 9, 'bsms_id' => 'bsms6636', 'is_competent' => 1, 'assessed_at' => '2026-02-18 16:21:03', 'created_at' => '2026-02-18 16:21:03', 'updated_at' => '2026-02-18 16:21:03'],
            ['id' => 2, 'examination_id' => 9, 'bsms_id' => 'bsms6636', 'is_competent' => 0, 'assessed_at' => '2026-02-18 16:21:05', 'created_at' => '2026-02-18 16:21:05', 'updated_at' => '2026-02-18 16:21:05'],
            ['id' => 3, 'examination_id' => 15, 'bsms_id' => 'bsms6636', 'is_competent' => 1, 'assessed_at' => '2026-02-18 16:21:27', 'created_at' => '2026-02-18 16:21:27', 'updated_at' => '2026-02-18 16:21:27'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examination_results');
    }
}
