<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exercise_primary_muscle', function (Blueprint $table) {
            $table->unsignedBigInteger('exercise_id');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');

            $table->unsignedBigInteger('muscle_id');
            $table->foreign('muscle_id')->references('id')->on('muscles')->onDelete('cascade');

            $table->primary(['exercise_id' , 'muscle_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('exercise_primary_muscle');
    }
};
