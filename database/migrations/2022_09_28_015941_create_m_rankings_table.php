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
        Schema::create('m_rankings', function (Blueprint $table) {
            $table->id();
            $table->float('hasil_akhir', 5, 3);
            $table->integer('ranking')->nullable();
            $table->unsignedBigInteger('m_alternatif_id');
            $table->foreign('m_alternatif_id')->references('id')->on('m_alternatifs')->onDelete('cascade');
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
        Schema::dropIfExists('m_rankings');
    }
};
