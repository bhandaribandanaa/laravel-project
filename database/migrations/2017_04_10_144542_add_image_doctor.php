<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageDoctor extends Migration
{
    public function up()
    {
        Schema::table('doctors', function($table){
            $table->text('image')->after('full_name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('doctors', function($table){
            $table->dropColumn('image');
        });
    }
}
