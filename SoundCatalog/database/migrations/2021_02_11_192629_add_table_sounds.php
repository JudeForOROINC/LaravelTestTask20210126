<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableSounds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('sounds')) {
            Schema::create('sounds', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('filename');
                $table->bigInteger('author_id');
                $table->bigInteger('category_id');
                $table->bigInteger('soundstatus_id');
                $table->timestamps();
                //$table->foreign('category_id')->references('id')->on('soundcategory')->onDelete('restrict');
            });
        }
    }//Id, Title, Filename, CategoryId, SoundStatusId

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sounds');
    }
}
