<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLocationSignoffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_signoffs', function (Blueprint $table) {
            $table->id();
            $table->string('location_barcode', 255);
            $table->string('bsms_id', 255);
            $table->string('reg_number_of_approver', 255)->nullable();
            $table->string('signoff_name', 255)->nullable();
            $table->longText('signature_svg')->nullable();
            $table->timestamp('created_at', 6)->useCurrent();
            $table->unsignedBigInteger('location_id');
            $table->string('location_postcode', 255)->nullable();
            
            // Index
            $table->index('location_id', 'idx_location_signoffs_location_id');
            
            // Foreign key to locations2025
            $table->foreign('location_id', 'fk_location_signoffs_location2025')
                  ->references('id')
                  ->on('locations2025')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // Insert data - only records with valid location_id (1-22 from locations2025)
        DB::table('location_signoffs')->insert([
            ['id' => 1, 'location_barcode' => 'BSMS-GP0004', 'bsms_id' => 'bsms6636', 'reg_number_of_approver' => '09876543', 'signoff_name' => 'cj taylor', 'signature_svg' => 'M 186 77 L 175 68 L 173 68 L 166 68 L 163 70 L 160 70 L 158 71 L 157 72 L 156 73 L 156 74 L 156 75 L 156 76 L 159 78 L 162 78 L 166 79 L 171 79 L 176 79 L 181 79 L 186 79 L 191 79 L 196 77 L 201 75 L 205 74 L 208 72 L 211 71 L 214 70 L 217 70 L 220 68 L 224 67 L 143 84 L 131 86 L 127 86 L 126 86 L 125 84 L 125 82 L 125 78 L 132 72', 'created_at' => '2026-02-12 13:13:40.601670', 'location_id' => 22, 'location_postcode' => null],
            ['id' => 2, 'location_barcode' => 'BSMS-GP0009', 'bsms_id' => 'bsms6636', 'reg_number_of_approver' => '09876543', 'signoff_name' => 'cj taylor', 'signature_svg' => 'M 140 42 L 135 55 L 153 66 L 148 60 L 148 56', 'created_at' => '2026-02-12 13:16:06.617070', 'location_id' => 22, 'location_postcode' => null],
            ['id' => 3, 'location_barcode' => 'BSMS-GP0005', 'bsms_id' => 'bsms6636', 'reg_number_of_approver' => '12234567', 'signoff_name' => 'taylor', 'signature_svg' => 'M 140 48 L 130 47 L 124 50 L 117 54 L 111 59 L 135 81 L 131 68', 'created_at' => '2026-02-12 14:47:14.668098', 'location_id' => 2, 'location_postcode' => null],
            ['id' => 4, 'location_barcode' => 'BSMS-GP0002', 'bsms_id' => 'bsms6636', 'reg_number_of_approver' => '098766533', 'signoff_name' => 'test', 'signature_svg' => 'M 259 11 L 256 0 L 123 66 L 116 66 L 116 71 L 116 76 L 117 79 L 186 79 L 185 73 L 186 70 L 191 67 L 253 126 L 254 117 L 254 112', 'created_at' => '2026-02-12 14:58:34.522974', 'location_id' => 2, 'location_postcode' => null],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_signoffs');
    }
}
