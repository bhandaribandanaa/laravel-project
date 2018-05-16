<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTime extends Migration
{
    
    public function up()
    {
        Schema::table('doctors_time_table', function($table){
            $table->dropColumn('time');
        });
    }

   
    public function down()
    {
        Schema::table('doctors_time_table', function($table){
            $table->string('time');
        });   
    }
}
