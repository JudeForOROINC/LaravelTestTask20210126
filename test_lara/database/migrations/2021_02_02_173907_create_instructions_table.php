<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('instructions')) {
            Schema::create('instructions', function (Blueprint $table) {
                $table->id()->autoIncrement();
                $table->string('name', 100);
                $table->string('description', 255);
                $table->string('filename', 255);
                $table->integer('status')->default(1);
                $table->integer('authorId');
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
