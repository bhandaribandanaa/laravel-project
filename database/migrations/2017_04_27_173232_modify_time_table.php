<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors_time_table', function($table){
            $table->dropColumn('day');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['0','1']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->string('day');
        $table->dropColumn('start_date');
        $table->dropColumn('end_date');
        $table->dropColumn('status', ['0','1']);
    }
}
