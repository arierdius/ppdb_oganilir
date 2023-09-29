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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran','50');
            $table->bigInteger('siswa_id');
            $table->bigInteger('sekolah_id');
            $table->string('jalur','50')->comment('umum,prestasi,afirmasi,zonasi');
            $table->string('status','30')->comment('diverifikasi,diterima, ditolak, menunggu');
            $table->date('tanggal_daftar','100')->nullable();
            $table->date('tanggal_ditolak','100')->nullable();
            $table->date('tanggal_diterima','100')->nullable();
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
        Schema::dropIfExists('pendaftaran');
    }
};
