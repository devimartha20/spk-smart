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
        Schema::create('m_nilai_smarts', function (Blueprint $table) {
            $table->unsignedBigInteger('m_alternatif_id');
            $table->unsignedBigInteger('m_kriteria_id');
            $table->primary(['m_alternatif_id', 'm_kriteria_id']);
            $table->foreign('m_alternatif_id')->references('id')->on('m_alternatifs')->onDelete('cascade');
            $table->foreign('m_kriteria_id')->references('id')->on('m_kriterias')->onDelete('cascade');
            $table->float('nilai_awal', 5, 3);
            $table->float('nilai_utility', 5, 3)->nullable();
            $table->float('nilai_akhir', 5, 3)->nullable();
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
        Schema::dropIfExists('m_nilai_smarts');
    }
};
