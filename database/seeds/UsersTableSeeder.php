<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
	            ['user_type'=>1,'full_name'=> 'developer', 'username' => 'developer','email_address' => 'adhikarysunil.1@gmail.com','password' => bcrypt('password'), 'is_active' => 1],
	            ['user_type'=>2,'full_name'=> 'superadmin',  'username' => 'superadmin','email_address' => 'pndc@peacenepal.com','password' => bcrypt('password'), 'is_active' => 1]
        	];
		
		DB::table('users')->insert($users);
    }
}
