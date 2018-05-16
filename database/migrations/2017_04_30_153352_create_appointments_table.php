<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function($table){
            $table->increments('id');
            $table->unsignedInteger('doctor_id');
            $table->date('date');
            $table->string('shift');
            $table->string('f_name');
            $table->string('address');
            $table->string('mobile');
            $table->string('email');
            $table->text('message');
            $table->enum('is_confirmed',['0','1']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
