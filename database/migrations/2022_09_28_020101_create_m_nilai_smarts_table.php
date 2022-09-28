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
        Schema::create('nilai_smarts', function (Blueprint $table) {
            $table->unsignedBigInteger('alternative_id');
            $table->unsignedBigInteger('criteria_id');
            $table->primary(['alternative_id', 'criteria_id']);
            $table->foreign('alternative_id')->references('id')->on('alternatives');
            $table->foreign('criteria_id')->references('id')->on('criterias');
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
