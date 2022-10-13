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
        Schema::create('bobots', function (Blueprint $table) {
            $table->id();
            $table->integer('point');
            $table->float('bobot', 5, 3)->nullable();
            $table->unsignedBigInteger('criteria_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('m_bobots');
    }
};
