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
        Schema::table('facilitators', function (Blueprint $table) {
$table->renameColumn('bsmsID', 'bsms_id');
$table->renameColumn('KnownAs', 'known_as');
$table->renameColumn('TeachingSubject', 'teaching_subject');
$table->renameColumn('JoiningDate', 'joining_date');
$table->renameColumn('Firstname', 'firstname');
$table->renameColumn('Surname', 'surname');
$table->renameColumn('EmailAddress', 'email');
$table->renameColumn('Address', 'address');
$table->renameColumn('Designation', 'designation');
$table->renameColumn('Qualification', 'qualification');
        });
    }


};
