<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveStatus extends Migration
{
    
    public function up()
    {
        Schema::table('doctors_time_table', function($table){
            $table->dropColumn('status');
        });
    }

   
    public function down()
    {
        Schema::table('doctors_time_table', function($table){
            $table->enum('status',['0','1']);
        });   
    }
}
