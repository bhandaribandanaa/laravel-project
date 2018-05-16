<?php

use Illuminate\Database\Seeder;

class MenuLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuLocation = [
            ['name' => "Header", 'description' => 'Header Menu','created_by'=>1, 'is_active' => 1],
            ['name' => "Footer", 'description' => 'Footer Menu','created_by'=>1, 'is_active' => 1],
            ['name' => "Sidebar", 'description' => 'Sidebar Menu','created_by'=>1, 'is_active' => 1],
        ];

        DB::table('menu_location')->insert($menuLocation);
    }
}
