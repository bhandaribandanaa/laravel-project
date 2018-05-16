<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagePackages extends Migration
{
    public function up()
    {
        Schema::table('packages', function($table){
            $table->text('image')->after('title')->nullable();
        });
    }
   
    public function down()
    {
        Schema::table('packages', function($table){
            $table->dropColumn('image');
        });
    }
}
