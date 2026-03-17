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
        Schema::table('physquiz', function (Blueprint $table) {
                    $table->text('explanation')->after('answer');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                      Schema::table('physquiz', function (Blueprint $table) {
                                  $table->dropColumn('explanation');
                              });
    }
};
