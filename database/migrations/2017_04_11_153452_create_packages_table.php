<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    public function up(){
        Schema::create('packages',function($table){
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->enum('status',['0','1']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function don(){
        Schema::dropIfExists('packages');
    }
}
