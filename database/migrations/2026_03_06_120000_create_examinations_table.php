<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('examination', 255);
            $table->string('category', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('active')->default(1);
            
            $table->index('active', 'idx_active');
            $table->index('category', 'idx_category');
            $table->index('sort_order', 'idx_sort_order');
        });

        // Insert data
        DB::table('examinations')->insert([
            ['id' => 1, 'examination' => 'Head Tilt Chin Lift', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 2, 'examination' => 'Jaw Thrust', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 3, 'examination' => 'Oropharyngeal Airway (OPA)', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 4, 'examination' => 'Nasopharyngeal Airway (NPA)', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 5, 'examination' => 'IGel', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 6, 'examination' => 'Suctions', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 7, 'examination' => 'Respiration Rates', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 8, 'examination' => 'Full Respiratory Assessment', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 9, 'examination' => 'Arterial Blood Gas (ABG)', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 10, 'examination' => 'Peak Expiratory Flow Rate (PEFR)', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 11, 'examination' => 'Pulse Check', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 12, 'examination' => 'Blood Pressure', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 13, 'examination' => 'Capillary Refill Time', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 14, 'examination' => 'Cardiovascular Assessment', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 15, 'examination' => 'Abdominal Assessment', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 16, 'examination' => 'Venepuncture', 'category' => null, 'sort_order' => 0, 'active' => 1],
            ['id' => 17, 'examination' => 'IV Cannulation inc VGB', 'category' => null, 'sort_order' => 0, 'active' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examinations');
    }
}
