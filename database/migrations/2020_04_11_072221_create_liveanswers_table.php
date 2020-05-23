<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liveanswers', function (Blueprint $table) {
            $table->engine = "MyISAM";
            $table->increments('id');
            $table->integer('livequestion_id');
            $table->text('answer');
            
            $table->foreign('livequestion_id')->references('id')->on('livequestions')->onDelete('cascade');
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
        Schema::dropIfExists('liveanswers');
    }
}
