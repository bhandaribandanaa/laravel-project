<?php

use Illuminate\Database\Seeder;

class EventsAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'parent_id' => '0',
            'module_name' => 'Events Management',
            'slug' => 'events-management',
            'is_active' => '1',
            'editable' => '1'
        ]);
        $insert_id = DB::getPdo()->lastInsertId();

        $access_lists = [
            ['user_type' => 1, 'module_id' => $insert_id, 'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1, 'access_publish' => 1, 'access_trash' => 1, 'access_reterive' => 1, 'is_active' => 1],
            ['user_type' => 2, 'module_id' => $insert_id, 'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1, 'access_publish' => 1, 'access_trash' => 1, 'access_reterive' => 1, 'is_active' => 1],
        ];

        DB::table('access_lists')->insert($access_lists);
    }
}
