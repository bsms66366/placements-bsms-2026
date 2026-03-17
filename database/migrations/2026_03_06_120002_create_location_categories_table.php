<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLocationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 11)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        // Insert data
        DB::table('location_categories')->insert([
            ['id' => 1, 'name' => 'Sim Flat', 'created_at' => '2026-02-11 14:30:00', 'updated_at' => '2026-02-11 14:30:00'],
            ['id' => 2, 'name' => 'IA', 'created_at' => '2026-02-11 14:30:00', 'updated_at' => '2026-02-11 14:30:00'],
            ['id' => 3, 'name' => 'Immersion', 'created_at' => '2026-02-11 14:30:00', 'updated_at' => '2026-02-11 14:30:00'],
            ['id' => 4, 'name' => 'GP', 'created_at' => '2026-02-11 14:30:00', 'updated_at' => '2026-02-11 14:30:00'],
            ['id' => 5, 'name' => 'C_hospital', 'created_at' => '2026-02-11 14:30:00', 'updated_at' => '2026-02-11 14:30:00'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_categories');
    }
}
