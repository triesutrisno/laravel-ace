<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('menu_id');
            $table->string('menu_nama',50);
            $table->string('menu_link',10)->nullable();
            $table->string('menu_keterangan',150)->nullable();
            $table->string('menu_parent',2)->nullable();
            $table->string('menu_status',2)->nullable();
            $table->string('menu_type',2)->nullable();
            $table->smallInteger('menu_sort')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
