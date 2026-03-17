<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePhaseOneStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phase_one_staff', function (Blueprint $table) {
            $table->integer('ID')->primary();
            $table->string('AboutStaff', 47);
            $table->string('StaffType', 11);
            $table->string('Creator', 21);
            $table->dateTime('CreatedAt');
        });

        // Insert data in chunks due to large dataset
        $staff_chunk1 = [
            ['ID' => 1, 'AboutStaff' => 'Claire Webster (BSMS)', 'StaffType' => 'Admin', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-06-13 11:47:00'],
            ['ID' => 11, 'AboutStaff' => 'Heather Shaw', 'StaffType' => 'Facilitator', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:37:00'],
            ['ID' => 12, 'AboutStaff' => 'Paige Gregory', 'StaffType' => 'Admin', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:38:00'],
            ['ID' => 13, 'AboutStaff' => 'Rosie Stanley', 'StaffType' => 'Facilitator', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:40:00'],
            ['ID' => 14, 'AboutStaff' => 'Natalie West', 'StaffType' => 'Admin', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:40:00'],
            ['ID' => 15, 'AboutStaff' => 'Lisa Kearley', 'StaffType' => 'Facilitator', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:40:00'],
            ['ID' => 16, 'AboutStaff' => 'Jenny Downing', 'StaffType' => 'Admin', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:41:00'],
            ['ID' => 17, 'AboutStaff' => 'Natalie Purchase', 'StaffType' => 'Admin', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:43:00'],
            ['ID' => 18, 'AboutStaff' => 'Giovanni Baracetti', 'StaffType' => 'Admin', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:43:00'],
            ['ID' => 19, 'AboutStaff' => 'Amelia Ackling', 'StaffType' => 'Admin', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-07-31 12:44:00'],
            ['ID' => 22, 'AboutStaff' => 'Timetable Test Bsms (student)', 'StaffType' => 'Facilitator', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-09-15 11:29:00'],
            ['ID' => 23, 'AboutStaff' => 'Jill Bennett', 'StaffType' => 'Facilitator', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-09-20 10:43:00'],
            ['ID' => 24, 'AboutStaff' => 'Pippa Walton', 'StaffType' => 'Facilitator', 'Creator' => 'Claire Webster (BSMS)', 'CreatedAt' => '2023-09-20 10:43:00'],
            ['ID' => 28, 'AboutStaff' => 'Holly Aymelek', 'StaffType' => 'Admin', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-09-25 12:05:00'],
            ['ID' => 29, 'AboutStaff' => 'Adam Faux', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 12:28:00'],
            ['ID' => 30, 'AboutStaff' => 'Jenny Katsoni', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:53:00'],
            ['ID' => 31, 'AboutStaff' => 'Susan Carter', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:54:00'],
            ['ID' => 32, 'AboutStaff' => 'Chris Haysom', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:54:00'],
            ['ID' => 33, 'AboutStaff' => 'Sarah Partridge', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:54:00'],
            ['ID' => 34, 'AboutStaff' => 'Anthony Funnell', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:55:00'],
            ['ID' => 35, 'AboutStaff' => 'Charlotte Gillams', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:55:00'],
            ['ID' => 36, 'AboutStaff' => 'Pravin Jain', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:56:00'],
            ['ID' => 37, 'AboutStaff' => 'Hannah Morley', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:56:00'],
            ['ID' => 38, 'AboutStaff' => 'Tabitha Morrison', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:56:00'],
            ['ID' => 39, 'AboutStaff' => 'Francis Richards', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:56:00'],
            ['ID' => 40, 'AboutStaff' => 'Muna Al-Jawad', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:57:00'],
            ['ID' => 41, 'AboutStaff' => 'Duncan Shrewsbury', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 15:57:00'],
            ['ID' => 42, 'AboutStaff' => 'Nina Arnesen', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:01:00'],
            ['ID' => 44, 'AboutStaff' => 'Zoha Shaikh', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:07:00'],
            ['ID' => 45, 'AboutStaff' => 'Susanna Petche', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:08:00'],
            ['ID' => 46, 'AboutStaff' => 'Amna Ghafoor', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:09:00'],
            ['ID' => 47, 'AboutStaff' => 'Laurie Simpson', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:09:00'],
            ['ID' => 48, 'AboutStaff' => 'Sarah Steward', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:10:00'],
            ['ID' => 49, 'AboutStaff' => 'Nicola Stone', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:10:00'],
            ['ID' => 50, 'AboutStaff' => 'Lucy Udeen', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:10:00'],
            ['ID' => 51, 'AboutStaff' => 'Zaina Zafarulla', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:10:00'],
            ['ID' => 52, 'AboutStaff' => 'Gaurish Chawla', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:11:00'],
            ['ID' => 53, 'AboutStaff' => 'Menaka Jegatheesan', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:11:00'],
            ['ID' => 54, 'AboutStaff' => 'Miriam Dias', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-09-26 16:14:00'],
            ['ID' => 55, 'AboutStaff' => 'Charlotte Walters', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:14:00'],
            ['ID' => 56, 'AboutStaff' => 'Lauren Hardie-Bick', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:15:00'],
            ['ID' => 57, 'AboutStaff' => 'Rishen Cattaree', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:16:00'],
            ['ID' => 58, 'AboutStaff' => 'Sam Kerbey', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2023-09-26 16:23:00'],
            ['ID' => 59, 'AboutStaff' => 'Anna Cressey', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-09-28 11:53:00'],
            ['ID' => 60, 'AboutStaff' => 'Sally Doust', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-09-28 11:53:00'],
            ['ID' => 61, 'AboutStaff' => 'Catherine Bryant', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-09-28 11:54:00'],
            ['ID' => 62, 'AboutStaff' => 'Angela Hart', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-09-28 11:54:00'],
            ['ID' => 63, 'AboutStaff' => 'Joseph Hedgecock Joseph Hedgecock', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-09-28 11:54:00'],
            ['ID' => 64, 'AboutStaff' => 'Natalie Novak', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-09-28 11:54:00'],
            ['ID' => 65, 'AboutStaff' => 'Hashim Al-Gailani', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-09-28 11:55:00'],
            ['ID' => 66, 'AboutStaff' => 'Maria Vazquez-Salazar', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-09-28 11:59:00'],
            ['ID' => 67, 'AboutStaff' => 'Michael Koenig', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-02 09:37:00'],
            ['ID' => 68, 'AboutStaff' => 'Anna Jones (Brighton and Sussex Medical School)', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-02 11:34:00'],
            ['ID' => 69, 'AboutStaff' => 'Danya Stone', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-02 11:37:00'],
            ['ID' => 70, 'AboutStaff' => 'Nick Dowell', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-02 11:39:00'],
            ['ID' => 71, 'AboutStaff' => 'Chantelle Rizan', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-02 11:46:00'],
            ['ID' => 72, 'AboutStaff' => 'Rachel Wilkins', 'StaffType' => 'Admin', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-10-02 12:20:00'],
            ['ID' => 73, 'AboutStaff' => 'Rachel Phillips', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-10-02 12:32:00'],
            ['ID' => 74, 'AboutStaff' => 'Max Bacon', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-10-02 12:32:00'],
            ['ID' => 75, 'AboutStaff' => 'Fallon John', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-10-02 12:33:00'],
            ['ID' => 76, 'AboutStaff' => 'Maria George', 'StaffType' => 'Facilitator', 'Creator' => 'Rosie Stanley', 'CreatedAt' => '2023-10-03 08:14:00'],
            ['ID' => 77, 'AboutStaff' => 'Richard De Visser', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 09:05:00'],
            ['ID' => 78, 'AboutStaff' => 'Peter West-Oram', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:20:00'],
            ['ID' => 79, 'AboutStaff' => 'Manuela Mengozzi', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:20:00'],
            ['ID' => 80, 'AboutStaff' => 'Simon Waddell', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:20:00'],
            ['ID' => 81, 'AboutStaff' => 'Saeideh Babashahi', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:20:00'],
            ['ID' => 82, 'AboutStaff' => 'Kate Alford', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:20:00'],
            ['ID' => 83, 'AboutStaff' => 'Elizabeth Ford', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:21:00'],
            ['ID' => 84, 'AboutStaff' => 'Clio Berry', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:21:00'],
            ['ID' => 85, 'AboutStaff' => 'Dominic O\'Brien', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:22:00'],
            ['ID' => 86, 'AboutStaff' => 'Yoko Nagai', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:22:00'],
            ['ID' => 87, 'AboutStaff' => 'Oli Steele', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:23:00'],
            ['ID' => 88, 'AboutStaff' => 'Snezana Levic', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:23:00'],
            ['ID' => 89, 'AboutStaff' => 'Nadia Terrazzini', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:24:00'],
            ['ID' => 90, 'AboutStaff' => 'Arianne Shahvisi', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:24:00'],
            ['ID' => 91, 'AboutStaff' => 'Jessica Stockdale', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:24:00'],
            ['ID' => 92, 'AboutStaff' => 'Sarah Polack', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-03 14:24:00'],
            ['ID' => 93, 'AboutStaff' => 'Karen Patterson', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-04 08:59:00'],
            ['ID' => 94, 'AboutStaff' => 'Elaney Youssef', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-04 09:54:00'],
            ['ID' => 95, 'AboutStaff' => 'Simon Mitchell', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-04 10:51:00'],
            ['ID' => 97, 'AboutStaff' => 'Shanu Sadhwani', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:17:00'],
            ['ID' => 98, 'AboutStaff' => 'Edina Husanovic', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:20:00'],
            ['ID' => 99, 'AboutStaff' => 'Khalid Ali', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:20:00'],
            ['ID' => 100, 'AboutStaff' => 'Daniel Hammond', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:21:00'],
        ];

        $staff_chunk2 = [
            ['ID' => 101, 'AboutStaff' => 'Kingsley Sage', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:21:00'],
            ['ID' => 102, 'AboutStaff' => 'Molly Hebditch', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:24:00'],
            ['ID' => 103, 'AboutStaff' => 'Yvonne Feeney', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:24:00'],
            ['ID' => 104, 'AboutStaff' => 'Nadya Catalan', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:24:00'],
            ['ID' => 105, 'AboutStaff' => 'Angus Nisbet', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 09:24:00'],
            ['ID' => 106, 'AboutStaff' => 'Hollie Cartwright', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-05 10:23:00'],
            ['ID' => 107, 'AboutStaff' => 'Juliette Crossman', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-05 10:28:00'],
            ['ID' => 108, 'AboutStaff' => 'Tom Blount', 'StaffType' => 'Facilitator', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2023-10-05 10:28:00'],
            ['ID' => 109, 'AboutStaff' => 'Jo White', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 14:54:00'],
            ['ID' => 110, 'AboutStaff' => 'Tam Gill', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-05 14:54:00'],
            ['ID' => 111, 'AboutStaff' => 'Amy Dolan', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-09 11:06:00'],
            ['ID' => 113, 'AboutStaff' => 'Gareth Chan Gareth Chan', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-09 11:35:00'],
            ['ID' => 114, 'AboutStaff' => 'Zara Jones', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-09 12:24:00'],
            ['ID' => 115, 'AboutStaff' => 'Ali Winstanley', 'StaffType' => 'Facilitator', 'Creator' => 'Amelia Ackling', 'CreatedAt' => '2023-10-10 08:33:00'],
            ['ID' => 118, 'AboutStaff' => 'Joanna Turner', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-10-13 15:36:00'],
            ['ID' => 119, 'AboutStaff' => 'Carl Fernandes', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-11-06 08:04:00'],
            ['ID' => 120, 'AboutStaff' => 'James Muggleton', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-11-06 12:37:00'],
            ['ID' => 121, 'AboutStaff' => 'Penny Geer', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-11-07 09:20:00'],
            ['ID' => 122, 'AboutStaff' => 'Girish Murali', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-11-09 10:30:00'],
            ['ID' => 123, 'AboutStaff' => 'Neil Singh', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-11-09 13:32:00'],
            ['ID' => 124, 'AboutStaff' => 'Vanessa Lynch', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2023-12-11 08:50:00'],
            ['ID' => 125, 'AboutStaff' => 'Damla Harmanci', 'StaffType' => 'Facilitator', 'Creator' => 'Natalie West', 'CreatedAt' => '2024-01-09 13:45:00'],
            ['ID' => 126, 'AboutStaff' => 'Harm Van Marwijk', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2024-01-29 15:56:00'],
            ['ID' => 129, 'AboutStaff' => 'Richard James', 'StaffType' => 'Admin', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2024-07-04 15:39:00'],
            ['ID' => 130, 'AboutStaff' => 'Lily Graham', 'StaffType' => 'Admin', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2024-08-30 14:29:00'],
            ['ID' => 132, 'AboutStaff' => 'Maria Gerguis', 'StaffType' => 'Admin', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2024-09-17 11:06:00'],
            ['ID' => 133, 'AboutStaff' => 'Marta Ferreira', 'StaffType' => 'Admin', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2024-09-23 12:49:00'],
            ['ID' => 134, 'AboutStaff' => 'Patrick Nyikavaranda', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2024-09-26 13:05:00'],
            ['ID' => 136, 'AboutStaff' => 'Sarla Campbell', 'StaffType' => 'Admin', 'Creator' => 'Lily Graham', 'CreatedAt' => '2024-10-04 16:40:00'],
            ['ID' => 137, 'AboutStaff' => 'Max Cooper', 'StaffType' => 'Facilitator', 'Creator' => 'Richard James', 'CreatedAt' => '2024-10-22 09:38:00'],
            ['ID' => 138, 'AboutStaff' => 'Ayesha Irfan', 'StaffType' => 'Facilitator', 'Creator' => 'Richard James', 'CreatedAt' => '2024-10-24 15:13:00'],
            ['ID' => 139, 'AboutStaff' => 'Megan Pretlove', 'StaffType' => 'Facilitator', 'Creator' => 'Lily Graham', 'CreatedAt' => '2024-10-29 10:18:00'],
            ['ID' => 140, 'AboutStaff' => 'Geoff Wells', 'StaffType' => 'Facilitator', 'Creator' => 'Holly Aymelek', 'CreatedAt' => '2024-12-05 13:04:00'],
            ['ID' => 141, 'AboutStaff' => 'Nina Lockwood', 'StaffType' => 'Facilitator', 'Creator' => 'Maria Gerguis', 'CreatedAt' => '2025-01-23 13:40:00'],
            ['ID' => 142, 'AboutStaff' => 'Sarah Smeed', 'StaffType' => 'Admin', 'Creator' => 'Giovanni Baracetti', 'CreatedAt' => '2025-02-18 14:58:00'],
            ['ID' => 143, 'AboutStaff' => 'Kate Pitt', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2025-04-28 09:34:00'],
            ['ID' => 144, 'AboutStaff' => 'Hannah Cheetham', 'StaffType' => 'Admin', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2025-08-13 14:31:00'],
            ['ID' => 145, 'AboutStaff' => 'Richard Holder', 'StaffType' => 'Facilitator', 'Creator' => 'Maria Gerguis', 'CreatedAt' => '2025-08-19 14:50:00'],
            ['ID' => 146, 'AboutStaff' => 'Kat Frere-Smith', 'StaffType' => 'Facilitator', 'Creator' => 'Maria Gerguis', 'CreatedAt' => '2025-08-19 14:51:00'],
            ['ID' => 148, 'AboutStaff' => 'Liz Fisher', 'StaffType' => 'Facilitator', 'Creator' => 'Holly Aymelek', 'CreatedAt' => '2025-09-23 11:55:00'],
            ['ID' => 149, 'AboutStaff' => 'Sofia Faircloth', 'StaffType' => 'Facilitator', 'Creator' => 'Holly Aymelek', 'CreatedAt' => '2025-09-23 11:55:00'],
            ['ID' => 150, 'AboutStaff' => 'Becky Ellis', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2025-10-16 13:22:00'],
            ['ID' => 151, 'AboutStaff' => 'Louise Dale', 'StaffType' => 'Facilitator', 'Creator' => 'Richard James', 'CreatedAt' => '2025-10-29 15:50:00'],
            ['ID' => 153, 'AboutStaff' => 'Thomas Scott', 'StaffType' => 'Facilitator', 'Creator' => 'Richard James', 'CreatedAt' => '2025-10-29 15:54:00'],
            ['ID' => 154, 'AboutStaff' => 'Joseph Severs', 'StaffType' => 'Facilitator', 'Creator' => 'Richard James', 'CreatedAt' => '2025-11-03 11:19:00'],
            ['ID' => 155, 'AboutStaff' => 'Lisa Sansom', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2025-11-04 12:58:00'],
            ['ID' => 156, 'AboutStaff' => 'Rich Gorman', 'StaffType' => 'Facilitator', 'Creator' => 'Richard James', 'CreatedAt' => '2025-11-05 12:58:00'],
            ['ID' => 157, 'AboutStaff' => 'Venetia Allan', 'StaffType' => 'Facilitator', 'Creator' => 'Richard James', 'CreatedAt' => '2025-11-05 12:58:00'],
            ['ID' => 158, 'AboutStaff' => 'Lucy Vickers', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2026-01-06 12:08:00'],
            ['ID' => 161, 'AboutStaff' => 'Soumen Basak', 'StaffType' => 'Facilitator', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2026-01-27 13:35:00'],
            ['ID' => 162, 'AboutStaff' => 'Cj Taylor', 'StaffType' => 'Admin', 'Creator' => 'Paige Gregory', 'CreatedAt' => '2026-02-05 13:41:00'],
        ];

        DB::table('phase_one_staff')->insert($staff_chunk1);
        DB::table('phase_one_staff')->insert($staff_chunk2);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phase_one_staff');
    }
}
