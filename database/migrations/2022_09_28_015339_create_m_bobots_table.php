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
        Schema::create('m_bobots', function (Blueprint $table) {
            $table->id();
            $table->integer('point');
            $table->float('bobot', 5, 3)->nullable();
            $table->unsignedBigInteger('m_kriteria_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('m_kriteria_id')->references('id')->on('m_kriterias')->onDelete('cascade');
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
