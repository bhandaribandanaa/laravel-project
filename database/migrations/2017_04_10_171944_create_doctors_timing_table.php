<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTimingTable extends Migration
{
    public function up(){
        Schema::create('doctors_time_table', function($table){
            $table->increments('id');
            $table->integer('doctor_id')->nullable();
            $table->string('day');
            $table->string('shift');
            $table->string('time');
            $table->enum('status',['0','1']);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    public function down(){
        Schema::dropIfExists('doctors_time_table');
    }
}
