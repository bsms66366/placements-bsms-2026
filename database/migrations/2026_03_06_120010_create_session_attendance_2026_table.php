<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSessionAttendance2026Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_attendance_2026', function (Blueprint $table) {
            $table->id();
            $table->string('bsms_id', 255);
            $table->dateTime('session_date', 6);
            $table->bigInteger('session_id');
            
            // Unique constraint
            $table->unique(['session_id', 'bsms_id'], 'session_attendance_2026_session_id_bsms_id_d5d05ac3_uniq');
            
            // Index
            $table->index('session_id', 'session_attendance_2026_session_id_8512ca70');
        });

        // Insert data
        DB::table('session_attendance_2026')->insert([
            ['id' => 1, 'bsms_id' => 'bsms6636', 'session_date' => '2026-02-17 17:10:48.021838', 'session_id' => 70],
            ['id' => 2, 'bsms_id' => 'bsms6636', 'session_date' => '2026-02-17 17:20:41.551756', 'session_id' => 148],
            ['id' => 3, 'bsms_id' => 'bsms6636', 'session_date' => '2026-02-17 17:35:09.520908', 'session_id' => 147],
            ['id' => 4, 'bsms_id' => 'bsms6636', 'session_date' => '2026-02-17 17:39:34.585985', 'session_id' => 9],
            ['id' => 5, 'bsms_id' => 'bsms6636', 'session_date' => '2026-03-02 13:52:58.218766', 'session_id' => 153],
            ['id' => 6, 'bsms_id' => 'bsms6636', 'session_date' => '2026-03-02 16:35:20.422843', 'session_id' => 122],
            ['id' => 7, 'bsms_id' => 'bsms6636', 'session_date' => '2026-03-02 16:35:45.592941', 'session_id' => 133],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_attendance_2026');
    }
}
