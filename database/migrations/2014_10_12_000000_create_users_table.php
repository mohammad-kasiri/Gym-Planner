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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('plan_id')->nullable();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');

            $table->timestamp('plan_expire_at')->nullable();

            $table->enum('level'  , ['admin', 'user'])->default('user');
            $table->enum('gender' , ['male' , 'female'])->nullable();
            $table->string('name')->nullable();

            $table->string('mobile' , 13)->unique();
            $table->timestamp('mobile_verified_at')->nullable();

            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->timestamp('birth_date')->nullable();

            $table->timestamp('last_login')->nullable();

            $table->string('password' , 100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
