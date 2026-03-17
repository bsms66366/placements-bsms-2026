<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Academic Skills Group')->nullable();
            $table->integer('Dissection Room Group')->nullable();
            $table->integer('Living Anatomy Group')->nullable();
            $table->integer('PIC Group')->nullable();
        });

        // Table is empty - no data to insert
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('systems_groups');
    }
}
