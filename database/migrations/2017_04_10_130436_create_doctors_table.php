<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    public function up(){
        Schema::create('doctors', function($table){
            $table->increments('id');
            $table->string('full_name');
            $table->string('professional_title');
            $table->string('contact');
            $table->string('address');
            $table->text('description');
            $table->enum('status', ['0', '1']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('doctors');
    }
}
