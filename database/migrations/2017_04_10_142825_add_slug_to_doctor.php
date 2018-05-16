<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToDoctor extends Migration
{
    public function up(){
        Schema::table('doctors',function($table){
            $table->string('slug')->after('id');
        });
    }

    public function drop(){
        Schema::table('doctors',function($table){
            $table->dropColumn('slug');
        });
    }
}
