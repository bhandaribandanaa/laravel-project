<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageDoctorMappingTable extends Migration
{
    
    public function up()
    {
        Schema::create('packages_doctors', function($table){
            $table->increments('id');
            $table->integer('doctor_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('packages_doctors');
    }
}
