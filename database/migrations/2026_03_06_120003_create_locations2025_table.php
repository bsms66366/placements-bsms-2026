<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLocations2025Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations2025', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('gp_address', 255);
            $table->string('gp_town', 255);
            $table->string('gp_postcode', 255);
            $table->string('gp_telno', 255);
            $table->string('gp_travel', 255);
            $table->string('barcode_no', 255)->default('');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        // Insert data
        $locations = [
            ['id' => 1, 'name' => 'Brockwood Medical Practice ', 'gp_address' => 'Tanners Meadow -Brockham', 'gp_town' => 'Betchworth', 'gp_postcode' => 'RH3 7NJ', 'gp_telno' => '01737 843259', 'gp_travel' => 'Meet Taxi at 12.45pm near the back entrance of Watson Building. Taxi will collect you from the practice for return journey.', 'barcode_no' => 'BSMS-GP0012', 'created_at' => '2022-05-04 13:43:50', 'updated_at' => '2022-05-05 18:45:31'],
            ['id' => 2, 'name' => 'Carden and New Larchwood Surgery', 'gp_address' => 'County Oak Medical Centre -Carden Hill', 'gp_town' => 'Brighton', 'gp_postcode' => 'BN1 8DD', 'gp_telno' => '01273 545932 /500156', 'gp_travel' => 'Take no. 5b Bus from Falmer Station to Top of Hawkhurt road. Walk approx 7 mins', 'barcode_no' => '', 'created_at' => '2022-05-04 13:43:50', 'updated_at' => '2022-05-05 18:46:36'],
            ['id' => 3, 'name' => 'Cuckfield Medical Practice', 'gp_address' => 'Glebe Road', 'gp_town' => 'Cuckfield ', 'gp_postcode' => 'RH17 5BQ', 'gp_telno' => '01444 458738', 'gp_travel' => 'Meet Taxi at 13.15 near the back entrance of Watson Building. Taxi will collect you from the practice for the return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:46:42'],
            ['id' => 4, 'name' => 'Dolphins Medical Practice', 'gp_address' => 'Butlers Green Road', 'gp_town' => 'Haywards Heath', 'gp_postcode' => 'RH16 4BN', 'gp_telno' => '01444 476520', 'gp_travel' => 'Meet Taxi at 13.15 near the back entrance of Watson Building. Taxi will collect you from the practice for the return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:46:45'],
            ['id' => 5, 'name' => 'Gossops Green Medical Centre', 'gp_address' => 'Hurt Close -Gossops Green', 'gp_town' => 'Crawley', 'gp_postcode' => 'RH11 8TY', 'gp_telno' => '01293 228328', 'gp_travel' => 'Meet Taxi at 13.15 near the back entrance of Watson Building. Taxi will collect you from the practice for the return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:46:47'],
            ['id' => 6, 'name' => 'Hartfield Surgery (Part of the Grrombridge Medical Group', 'gp_address' => 'Old Crown Farm', 'gp_town' => 'Hartfield', 'gp_postcode' => 'TN7 4AD', 'gp_telno' => '01892 863326', 'gp_travel' => 'Meet Taxi at 13.10 near the back entrance of Watson Building. Taxi will collect you from the practice for the return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:46:50'],
            ['id' => 7, 'name' => 'Henfield Medical Centre', 'gp_address' => 'Deer Park -High Street', 'gp_town' => 'Henfield', 'gp_postcode' => 'BN5 9JQ', 'gp_telno' => '01273 492255', 'gp_travel' => 'Meet Taxi at 13.15 near the back entrance of Watson Building. Taxi will collect you from the practice for the return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:46:52'],
            ['id' => 8, 'name' => 'Holbrook Surgery', 'gp_address' => 'Bartholomew Way', 'gp_town' => 'Horsham', 'gp_postcode' => 'RH12 5JL', 'gp_telno' => '01403 339818', 'gp_travel' => 'Meet Taxi at 13.10 near the back entrance of Watson Building. Taxi will collect you from the practice for the return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:46:55'],
            ['id' => 9, 'name' => 'Hove Medical Centre', 'gp_address' => 'West Way', 'gp_town' => 'Hove', 'gp_postcode' => 'BN3 8LD', 'gp_telno' => '01273 430088 ', 'gp_travel' => 'Take No5b Bus from Falmer Station to the Library. Approx. 1 min walk. Take the Brighton Train from Falmer station and change at Brighton and pick up the Southampton Central, get off at Portslade then 20 min walk.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:46:57'],
            ['id' => 10, 'name' => 'Judges Close Surgery', 'gp_address' => 'High street', 'gp_town' => 'East Grinstead', 'gp_postcode' => 'RH 19 3AA', 'gp_telno' => '01342 317820', 'gp_travel' => 'Meet Taxi at 13:00 near the back entrance of Watson Building. Taxi will collect you from the practice for the return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:00'],
            ['id' => 11, 'name' => 'Langley House Surgery', 'gp_address' => '27 West Street', 'gp_town' => 'Chichester', 'gp_postcode' => 'PO19 1RW', 'gp_telno' => '01243 782266', 'gp_travel' => 'Meet Taxi at 12.45 near the back entrance of Watson Building. Taxi will collect you from the practice for the return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:04'],
            ['id' => 12, 'name' => 'Lime Tree Surgery', 'gp_address' => 'Lime Tree Avenue -Findon Valley', 'gp_town' => 'Worthing', 'gp_postcode' => 'BN14 0DL', 'gp_telno' => '01903 264101', 'gp_travel' => 'Meet Taxi at 13.00 near the back entrance of Watson Building. Taxi will collect you from the practice for return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:07'],
            ['id' => 13, 'name' => 'Linfield Medical Centre', 'gp_address' => 'High street', 'gp_town' => 'Lindfield', 'gp_postcode' => 'RH16 2HX', 'gp_telno' => '01444 484056', 'gp_travel' => 'Meet Taxi at 13.00 near the back entrance of Watson Building. Taxi will collect you from the practice for return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:09'],
            ['id' => 14, 'name' => 'Park Surgery', 'gp_address' => 'Albion Way', 'gp_town' => 'Horsham', 'gp_postcode' => 'RH12 1BG', 'gp_telno' => '01403 214619', 'gp_travel' => 'Meet Taxi at 13.00 near the back entrance of Watson Building. Taxi will collect you from the practice for return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:12'],
            ['id' => 15, 'name' => 'Selden Medical Centre', 'gp_address' => '6 Selden Road', 'gp_town' => 'Worthing', 'gp_postcode' => 'BN11 2LL', 'gp_telno' => '01903 234962', 'gp_travel' => 'Meet Taxi at 13.15 near the back entrance of Watson Building. Taxi will collect you from the practice for return journey.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:15'],
            ['id' => 16, 'name' => 'St Peters Medical Centre', 'gp_address' => '30-36 Oxford Street', 'gp_town' => 'Brighton', 'gp_postcode' => 'BN1 4LA', 'gp_telno' => '01273 606006', 'gp_travel' => 'Take no.5b Bus from Falmer station to Baker Street. Walk approx 2mins. or Take the train Falmer to Brighton. Walk approx 7mins.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:17'],
            ['id' => 17, 'name' => 'The Broadway Surgery ', 'gp_address' => '179 Whitehawk Road -Whitehawk Road', 'gp_town' => 'Brighton', 'gp_postcode' => 'BN2 5FL', 'gp_telno' => '01273 600888', 'gp_travel' => 'Take no.25 Bus from Brighton University Falmer to Old Steine, change to no.1 bus from St James Street to St Davids Hall. Walk approx 5mins.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:20'],
            ['id' => 18, 'name' => 'The Haven Practice', 'gp_address' => '100 Beaconsfield Villas', 'gp_town' => 'Brighton', 'gp_postcode' => 'BN1 6HE', 'gp_telno' => '01273 555999', 'gp_travel' => 'Take no.5b Bus from Falmer station to Beaconsfield Villas Top. Walk aprox. 1 min', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:23'],
            ['id' => 19, 'name' => 'The Orchard Surgery', 'gp_address' => 'Penstone Park', 'gp_town' => 'Lancing', 'gp_postcode' => 'BN15 9AG', 'gp_telno' => '01903 875900', 'gp_travel' => 'Take the train Falmer to Brighton then Brighton to Lancing. Walk approx 2mins to the surgery.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:26'],
            ['id' => 20, 'name' => 'Trinity Medical Centre', 'gp_address' => '1 Goldstone Villas ', 'gp_town' => 'Hove', 'gp_postcode' => 'BN3 3AT', 'gp_telno' => '01273 744910', 'gp_travel' => 'Take no.5b Bus from Falmer Station to George Street. Approx 1 min walk or Take the train from Falmer to Brighton then change and take a train to Hove, then 14 min walk.', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:29'],
            ['id' => 21, 'name' => 'Wellsbourne Healthcare CIC', 'gp_address' => '179 Whitehawk Road', 'gp_town' => 'Brighton', 'gp_postcode' => 'BN2 5FL', 'gp_telno' => '01273 005444', 'gp_travel' => 'Take no.5b Bus from Falmer Station to Old Steine change to no.1 Bus from St James Street to St Davids Hall. Walk approx 5mins.', 'barcode_no' => '215', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:31'],
            ['id' => 22, 'name' => 'Brighton Health and Wellbeing Centre', 'gp_address' => '18-19 Western Road ', 'gp_town' => 'Hove', 'gp_postcode' => 'BN3 1AE', 'gp_telno' => '01273 712185', 'gp_travel' => 'Take the Train from Falmer to Brighton and then take no.6 bus from Brighton station to Norfolk square 1 min walk from surgery. OR Walk approx 25 min to surgery from Brighton station', 'barcode_no' => '', 'created_at' => '2022-05-05 18:31:00', 'updated_at' => '2022-05-05 18:47:34'],
        ];

        DB::table('locations2025')->insert($locations);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations2025');
    }
}
