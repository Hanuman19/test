<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_project');
            $table->bigInteger('id_user_mo')->nullable();
            $table->bigInteger('id_user_tu')->nullable();
            $table->bigInteger('id_user_we')->nullable();
            $table->bigInteger('id_user_thu')->nullable();
            $table->bigInteger('id_user_fri')->nullable();
            $table->bigInteger('id_user_sa')->nullable();
            $table->bigInteger('id_user_su')->nullable();            
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
        Schema::dropIfExists('plans');
    }
}
