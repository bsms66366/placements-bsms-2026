<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupFieldsToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('seminar_group', 255)->nullable()->after('rotation_group');
            $table->string('cpw', 255)->nullable()->after('seminar_group');
            $table->string('cps', 255)->nullable()->after('cpw');
            $table->string('cpw_cps', 255)->nullable()->after('cps');
            $table->string('simulated_home_visit_group', 255)->nullable()->after('cpw_cps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['seminar_group', 'cpw', 'cps', 'cpw_cps', 'simulated_home_visit_group']);
        });
    }
}
