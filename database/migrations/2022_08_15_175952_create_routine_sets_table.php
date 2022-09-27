<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine_sets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('routine_item_id');
            $table->foreign('routine_item_id')->references('id')->on('routine_items')->onDelete('cascade');

            $table->json('amount');
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
        Schema::dropIfExists('routine_sets');
    }
};
