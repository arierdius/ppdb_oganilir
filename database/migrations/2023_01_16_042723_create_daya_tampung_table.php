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
        Schema::create('daya_tampung', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sekolah_id');
            $table->string('rombel','3');
            $table->string('daya_tampung_awal','5');
            $table->string('siswa_tidak_naik','5');
            $table->string('daya_tampung_ppd','5');
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
        Schema::dropIfExists('daya_tampung');
    }
};
