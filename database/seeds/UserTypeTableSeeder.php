<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_types = [
                ['user_type_name'=>'developer','editable'=>0,'is_active' => 1],
                ['user_type_name'=>'superadmin','editable'=>0,'is_active' => 1],
	            ['user_type_name'=>'normal','editable'=>0,'is_active' => 1]
        	];
		
		DB::table('user_types')->insert($user_types);
    }
}
