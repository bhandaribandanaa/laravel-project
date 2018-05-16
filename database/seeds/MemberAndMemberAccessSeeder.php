<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MemberAndMemberAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert to modules table
        DB::table('modules')->insert([
            'parent_id' => '0',
            'module_name' => 'Member Management',
            'slug' => 'member-management',
            'is_active' => '1',
            'editable' => '1',
            'created_at'=> Carbon::now()
        ]);
        $insert_id = DB::getPdo()->lastInsertId();

        // insert to access_list table
        $access_lists = [
            ['user_type' => 1, 'module_id' => $insert_id, 'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1, 'access_publish' => 1, 'access_trash' => 1, 'access_reterive' => 1, 'is_active' => 1,'created_at'=> Carbon::now()],
            ['user_type' => 2, 'module_id' => $insert_id, 'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1, 'access_publish' => 1, 'access_trash' => 1, 'access_reterive' => 1, 'is_active' => 1,'created_at'=> Carbon::now()],
        ];

        DB::table('access_lists')->insert($access_lists);

        // insert to user type table

        $member_types = [
            ['member_type_name'=>'Life member','slug'=>'life-member','description'=>'Life member','is_active'=>'1','created_by'=>'1','created_at'=> Carbon::now()],
            ['member_type_name'=>'Associative member','slug'=>'associative-member','description'=>'Associative member','is_active'=>'1','created_by'=>'1','created_at'=> Carbon::now()],
        ];
        DB::table('members_type')->insert($member_types);

    }
}
