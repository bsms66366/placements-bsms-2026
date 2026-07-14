<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FixExaminationResultsIdAutoincrement extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE examination_results MODIFY id bigint(20) NOT NULL AUTO_INCREMENT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE examination_results MODIFY id bigint(20) NOT NULL');
    }
}
