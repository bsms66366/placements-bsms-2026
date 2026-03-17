<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pathpots', function (Blueprint $table) {
            //$table->LONGBLOB('urlCode')->change();
          $table->binary('urlCode')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pathpots', function (Blueprint $table) {
                      $table->dropColumn('urlCode');
        });
    }
};
