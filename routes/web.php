<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', App\Http\Livewire\Admin\Dashboard::class)->name('dashboard');

// privacy
Route::get('/privacy', App\Http\Livewire\Privacy\Index::class)->name('privacy');

// SUPER ADMIN

// Data Sekolah
// middleware data sekolah
Route::middleware(['only.diknas'])->group(function () {
    Route::get('/admin/data_sekolah', App\Http\Livewire\Admin\DataSekolah\Index::class)->name('admin.data_sekolah.index');
    Route::get('/admin/data_sekolah/edit/{id}', App\Http\Livewire\Admin\DataSekolah\Edit::class)->name('admin.data_sekolah.edit');
    Route::get('/admin/profil_sekolah', App\Http\Livewire\Admin\ProfilSekolah\Index::class)->name('admin.profil_sekolah.index');
    Route::get('/admin/pengumuman', App\Http\Livewire\Admin\Pengumuman\Index::class)->name('admin.pengumuman.index');
    // sekolah area
    Route::get('/admin/sekolah_area/{id?}', App\Http\Livewire\Admin\SekolahArea\Index::class)->name('admin.sekolah_area.index');
    // kontak
    Route::get('/admin/kontak', App\Http\Livewire\Admin\Kontak\Index::class)->name('admin.kontak.index');
    // kontrol jalur
    Route::get('/admin/kontrol_jalur', App\Http\Livewire\Admin\KontrolJalur\Index::class)->name('admin.kontrol_jalur.index');
    // jadwal
    Route::get('/admin/jadwal', App\Http\Livewire\Admin\Jadwal\Index::class)->name('admin.jadwal.index');

    // KELOLA USER
    Route::get('/admin/user/sekolah', App\Http\Livewire\Admin\User\UserSekolah::class)->name('sekolah.user.index');

    Route::get('/admin/pengumuman-kelulusan', App\Http\Livewire\Admin\PengumumanKelulusan\Index::class)->name('admin.pengumuman.kelulusan.index');

});

// Route::get('/admin/data_sekolah', App\Http\Livewire\Admin\DataSekolah\Index::class)->name('admin.data_sekolah.index');
// Route::get('/admin/data_sekolah/edit/{id}', App\Http\Livewire\Admin\DataSekolah\Edit::class)->name('admin.data_sekolah.edit');

// Profil Sekolah

// ADMIN SEKOLAH
Route::middleware(['only.sekolah'])->group(function () {
    // dashboard
    Route::get('/admin/dashboard', App\Http\Livewire\Sekolah\Dashboard::class)->name('sekolah.dashboard.index');

    // Master Data
    Route::get('/sekolah/profil_sekolah', App\Http\Livewire\Sekolah\ProfilSekolah\Index::class)->name('sekolah.profil_sekolah.index');
    Route::get('/sekolah/daya_tampung', App\Http\Livewire\Sekolah\DayaTampung\Index::class)->name('sekolah.daya_tampung.index');

    // Persyaratan
    Route::get('/sekolah/persyaratan', App\Http\Livewire\Sekolah\Persyaratan\Zonasi::class)->name('sekolah.persyaratan.zonasi.index');
    Route::get('/sekolah/persyaratan/delete{id}', App\Http\Livewire\Sekolah\Persyaratan\Zonasi::class)->name('sekolah.persyaratan.zonasi.delete');
    Route::get('/sekolah/persyaratan/prestasi', App\Http\Livewire\Sekolah\Persyaratan\Prestasi::class)->name('sekolah.persyaratan.prestasi.index');
    Route::get('/sekolah/persyaratan/afirmasi', App\Http\Livewire\Sekolah\Persyaratan\Afirmasi::class)->name('sekolah.persyaratan.afirmasi.index');
    Route::get('/sekolah/persyaratan/mutasi', App\Http\Livewire\Sekolah\Persyaratan\Mutasi::class)->name('sekolah.persyaratan.mutasi.index');

    // ZONASI
    Route::get('/sekolah/zonasi', App\Http\Livewire\Admin\Zonasi\Pendaftar::class)->name('admin.zonasi.index');
    Route::get('/sekolah/zonasi/lulus', App\Http\Livewire\Admin\Zonasi\Lulus::class)->name('admin.zonasi.lulus.index');
    Route::get('/sekolah/zonasi/tidak_lulus', App\Http\Livewire\Admin\Zonasi\Tolak::class)->name('admin.zonasi.tidak.lulus.index');
    Route::get('/sekolah/zonasi/verifikasi', App\Http\Livewire\Admin\Zonasi\Verifikasi::class)->name('admin.zonasi.verifikasi.index');

    // PRESTASI
    Route::get('/sekolah/prestasi', App\Http\Livewire\Admin\Prestasi\Pendaftar::class)->name('admin.prestasi.index');
    Route::get('/sekolah/prestasi/lulus', App\Http\Livewire\Admin\Prestasi\Lulus::class)->name('admin.prestasi.lulus.index');
    Route::get('/sekolah/prestasi/tidak_lulus', App\Http\Livewire\Admin\Prestasi\Tolak::class)->name('admin.prestasi.tidak.lulus.index');
    Route::get('/sekolah/prestasi/verifikasi', App\Http\Livewire\Admin\Prestasi\Verifikasi::class)->name('admin.prestasi.verifikasi.index');

    // AFIRMASI
    Route::get('/sekolah/afirmasi', App\Http\Livewire\Admin\Afirmasi\Pendaftar::class)->name('admin.afirmasi.index');
    Route::get('/sekolah/afirmasi/lulus', App\Http\Livewire\Admin\Afirmasi\Lulus::class)->name('admin.afirmasi.lulus.index');
    Route::get('/sekolah/afirmasi/tidak_lulus', App\Http\Livewire\Admin\Afirmasi\Tolak::class)->name('admin.afirmasi.tidak.lulus.index');
    Route::get('/sekolah/afirmasi/verifikasi', App\Http\Livewire\Admin\Afirmasi\Verifikasi::class)->name('admin.afirmasi.verifikasi.index');

    // MUTASI
    Route::get('/sekolah/mutasi', App\Http\Livewire\Admin\Mutasi\Pendaftar::class)->name('admin.mutasi.index');
    Route::get('/sekolah/mutasi/lulus', App\Http\Livewire\Admin\Mutasi\Lulus::class)->name('admin.mutasi.lulus.index');
    Route::get('/sekolah/mutasi/tidak_lulus', App\Http\Livewire\Admin\Mutasi\Tolak::class)->name('admin.mutasi.tidak.lulus.index');
    Route::get('/sekolah/mutasi/verifikasi', App\Http\Livewire\Admin\Mutasi\Verifikasi::class)->name('admin.mutasi.verifikasi.index');

    // OPERATOR
    Route::get('/sekolah/operator', App\Http\Livewire\Sekolah\Operator\Index::class)->name('sekolah.operator.index');
    Route::get('/sekolah/profil', App\Http\Livewire\Sekolah\Operator\Profil::class)->name('sekolah.profil.index');

    // reset siswa
    Route::get('/sekolah/reset', App\Http\Livewire\Sekolah\Reset\Siswa::class)->name('sekolah.reset.index');

    // LAPORAN
    Route::get('/sekolah/laporan', App\Http\Livewire\Sekolah\Laporan\Index::class)->name('sekolah.laporan.index');
    // Route::get('/sekolah/laporan/pendaftar', App\Http\Livewire\Sekolah\Laporan\Index::class)->name('sekolah.laporan.zonasi.index');

    // revisi data siswa
    Route::get('/zonasi/revisi/{id?}', App\Http\Livewire\Sekolah\Perubahan\Zonasi::class)->name('sekolah.revisi.zonasi.index');
    Route::get('/mutasi/revisi/{id?}', App\Http\Livewire\Sekolah\Perubahan\Mutasi::class)->name('sekolah.revisi.mutasi.index');
    Route::get('/afirmasi/revisi/{id?}', App\Http\Livewire\Sekolah\Perubahan\Afirmasi::class)->name('sekolah.revisi.afirmasi.index');
    Route::get('/prestasi/revisi/{id?}', App\Http\Livewire\Sekolah\Perubahan\Prestasi::class)->name('sekolah.revisi.prestasi.index');

});


Route::middleware(['only.siswa'])->group(function () {
    // dashboard
    Route::get('/siswa/dashboard', App\Http\Livewire\Siswa\Dashboard\Index::class)->name('siswa.dashboard.index');

    // SISWA
    Route::get('/siswa/profil', App\Http\Livewire\Siswa\Profil::class)->name('siswa.profil.index');
    // zonasi
    Route::get('/siswa/pendaftaran/zonasi', App\Http\Livewire\Siswa\Zonasi\Index::class)->name('siswa.zonasi.index');  // zonasi
    // afirmasi
    Route::get('/siswa/pendaftaran/afirmasi', App\Http\Livewire\Siswa\Afirmasi\Index::class)->name('siswa.afirmasi.index');
    // mutasi
    Route::get('/siswa/pendaftaran/mutasi', App\Http\Livewire\Siswa\Mutasi\Index::class)->name('siswa.mutasi.index');
    // prestasi
    Route::get('/siswa/pendaftaran/prestasi', App\Http\Livewire\Siswa\Prestasi\Index::class)->name('siswa.prestasi.index');
});

// cetak pendaftaran
Route::get('/siswa/pendaftaran/cetak/mutasi', App\Http\Livewire\Siswa\Cetak\PendaftaranMutasi::class)->name('siswa.mutasi.cetak.index');
Route::get('/siswa/pendaftaran/cetak/afirmasi', App\Http\Livewire\Siswa\Cetak\PendaftaranAfirmasi::class)->name('siswa.afirmasi.cetak.index');
Route::get('/siswa/pendaftaran/cetak', App\Http\Livewire\Siswa\Cetak\PendaftaranZonasi::class)->name('siswa.zonasi.cetak.index');
Route::get('/siswa/pendaftaran/cetak/prestasi', App\Http\Livewire\Siswa\Cetak\PendaftaranPrestasi::class)->name('siswa.prestasi.cetak.index');



// END USER
Route::get('/', App\Http\Livewire\Umum\Dashboard\Index::class)->name('umum.dashboard.index');
Route::get('/sd', App\Http\Livewire\Umum\SD\Index::class)->name('umum.sd.index');

// jadwal
Route::get('/jadwal', App\Http\Livewire\Umum\Jadwal\Index::class)->name('umum.jadwal.index');

// data sekolah
Route::get('/data-sekolah', App\Http\Livewire\Umum\DataSekolah\Index::class)->name('umum.data-sekolah.index');

// Login
Route::get('/login', App\Http\Livewire\Auth\Login::class)->name('auth.login.index');
Route::get('/reset_password_calon_siswa', App\Http\Livewire\Auth\Reset::class)->name('auth.reset.index');
// Route::get('/logout', App\Http\Livewire\Auth\Logout::class)->name('auth.logout.index');

// register
Route::get('/register', App\Http\Livewire\Auth\Register::class)->name('auth.register.index');

Route::get('generate-pdf','PDFController@generatePDF');

// Route::get('/produk', App\Http\Livewire\Admin\Produk\Index::class)->name('admin.produk.index');
// Route::get('/sales/add', App\Http\Livewire\Admin\Produk\Add::class)->name('admin.produk.add');
// Route::get('/sales/edit/{id}', App\Http\Livewire\Admin\Produk\Edit::class)->name('admin.produk.edit');
