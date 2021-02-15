<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoundсomplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soundсomplaints', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');//TODO : add foreign key later;
            $table->integer('sound_id');//TODO : add foreign key later;
            $table->string('description');
          //  $table->foreign('soundсomplaint_statuses_id')->references('id')->on('soundсomplaint_statuses');

            $table->integer('soundсomplaint_statuses_id');//TODO : add foreign key later;

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
        Schema::dropIfExists('soundсomplaints');
    }
}
