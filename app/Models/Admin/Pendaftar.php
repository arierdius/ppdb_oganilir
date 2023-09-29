<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users_detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftar extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran';

    // make relasi to table user where siswa id hasone
    public function siswa()
    {
        return $this->hasOne(User::class, 'id', 'siswa_id');
    }

    // make relasi hasOne to Sekolah where id sekolah
    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'id', 'sekolah_id');
    }

    // make relasi pendaftar to users_detail where siswa id
    public function detail()
    {
        return $this->hasOne(Users_detail::class, 'user_id', 'siswa_id');
    }

    // make relasi bilongsto to Zonasi where id sekolah
    public function zonasi()
    {
        return $this->hasOne(Zonasi::class, 'pendaftaran_id', 'id');
    }

    // make relasi hasone to afirmasi
    public function afirmasi()
    {
        return $this->hasOne(Afirmasi::class, 'pendaftaran_id', 'id');
    }

    // make relasi hasone to mutasi
    public function mutasi()
    {
        return $this->hasOne(Mutasi::class, 'pendaftaran_id', 'id');
    }

    // make relasi hasone to prestasi
    public function prestasi()
    {
        return $this->hasOne(Prestasi::class, 'pendaftaran_id', 'id');
    }
}
