<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInstructions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('instructions')) {
            Schema::create('instructions', function (Blueprint $table){
                $table->increments('id');
                $table->string('name',100);
                $table->string('description',250)->nullable();
                $table->string('filename',255)->nullable();
                $table->integer('status')->default(1);
                $table->integer('userId');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructions');
    }
}
