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
        Schema::create('zonasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pendaftaran_id');
            $table->string('latitude_siswa','50');
            $table->string('longitude_siswa','50');
            $table->string('jarak','50');
            $table->string('file_bta','200')->nullable();
            $table->string('file_nisn','200')->nullable();
            $table->string('file_akte_kelahiran','200')->nullable();
            $table->string('file_kk','200')->nullable();
            $table->string('surat_keterangan_lulus','200')->nullable();
            $table->string('file_surat_pengantar','200')->nullable();
            $table->string('file_surat_pernyataan','200')->nullable();
            $table->string('file_surat_domisili','200')->nullable();
            $table->string('usia_kk','20');
            $table->date('tahun','20');
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
        Schema::dropIfExists('zonasi');
    }
};
