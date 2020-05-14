<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userrole', function (Blueprint $table) {
            $table->bigIncrements('userroleid');
            $table->smallInteger('userid');
            $table->string('role_nama',50);
            $table->timestamps();
        });
        
        /**
         * 
        Schema::table('userrole', function(Blueprint $table)
        {
            //$table->foreign('user_id', 'addresses_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('role_nama')->references('role_nama')->on('role');
        });
         * 
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userrole');
    }
}
