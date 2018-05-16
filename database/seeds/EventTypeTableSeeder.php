<?php

use Illuminate\Database\Seeder;

class EventTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventType = [
            ['name' => "Monthly CME", 'slug' => 'monthly-cme','description'=>'Monthly CME', 'created_by' => 1],
            ['name' => "Workshops", 'slug' => 'workshops','description'=>'Workshops', 'created_by' => 1],
            ['name' => "Mid Term Conference", 'slug' => 'mid-term-conference','description'=>'Mid Term Conference', 'created_by' => 1],
            ['name' => "International Conference", 'slug' => 'international-conference','description'=>'International Conference', 'created_by' => 1],
        ];

        DB::table('event_type')->insert($eventType);
    }
}
