<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTypeTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        $this->call(AccessListTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenuLocationSeeder::class);
        $this->call(ContentAccessSeeder::class);
        $this->call(EventTypeTableSeeder::class);
        $this->call(EventsAccessSeeder::class);
        
        Model::reguard();
    }
}
