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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah','100');
            $table->string('npsn','100');
            $table->text('alamat');
            $table->bigInteger('jenis_sekolah_id');
            $table->bigInteger('kecamatan_id');
            $table->string('telepon','100');
            $table->string('latitude','100');
            $table->string('longitude','100');
            $table->string('kepala_sekolah','100');
            $table->string('faksmili','100');
            $table->string('Akreditasi','100');
            $table->string('surel','100');
            $table->string('situs_web','100');
            $table->text('foto');
            $table->text('logo');
            $table->text('visi_misi');
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
        Schema::dropIfExists('produk');
    }
};
