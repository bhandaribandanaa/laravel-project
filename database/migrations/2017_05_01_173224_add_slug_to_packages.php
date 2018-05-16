<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToPackages extends Migration
{
    public function up(){
        Schema::table('packages',function($table){
            $table->string('slug')->after('id');
        });
    }

    public function drop(){
        Schema::table('packages',function($table){
            $table->dropColumn('slug');
        });
    }
}
