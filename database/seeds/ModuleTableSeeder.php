<?php

use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [	            	            
                ['module_name'=>'Configuration','slug'=>'configuration','parent_id'=>0,'editable'=>0,'is_active' => 1],
	            ['module_name'=>'Modules','slug'=>'modules','parent_id'=>1,'editable'=>0,'is_active' => 1],
                ['module_name'=>'User Type','slug'=>'user-type','parent_id'=>1,'editable'=>0,'is_active' => 1],
	            ['module_name'=>'Users','slug'=>'users','parent_id'=>0,'editable'=>0,'is_active' => 1],
//                ['parent_id'=>'0','module_name'=>'Content Management','slug'=>'content-management','is_active'=>'1','editable'=>'1']
        	];
		
		DB::table('modules')->insert($modules);
    }
}
