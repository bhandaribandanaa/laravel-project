<?php

use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sp = [['title' => 'Cardio', 'status' => '1'],
                ['title' => 'Diabetes', 'status' => '1']];

        DB::table('specializations')->insert($sp);
    }
}
