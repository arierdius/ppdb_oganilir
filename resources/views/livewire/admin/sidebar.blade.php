<div>
    @php
        use App\Models\Admin\Kontrol_jalur;
    @endphp
    <!-- Page Sidebar Start-->
    <header class="main-nav">
        <div class="sidebar-user text-center"></a>
            @if (isset(auth()->user()->users_detail))
                @if (auth()->user()->users_detail->foto != null)
                    <img class="img-90 rounded-circle" style="max-height: 100px;max-width: 100px;"
                        src="{{ asset('storage/foto_siswa/' . auth()->user()->users_detail->foto) }}" alt="">
                @else
                    <img class="img-90 rounded-circle" src="{{ asset('assets/images/dashboard/1.png') }}" alt="">
                    <div class="badge-bottom"><span class="badge badge-primary">Avatar</span></div><a
                        href="user-profile.html">
                @endif
            @else
                <img class="img-90 rounded-circle" src="{{ asset('assets/images/dashboard/1.png') }}" alt="">
                <div class="badge-bottom"><span class="badge badge-primary">Avatar</span></div><a
                    href="user-profile.html">
            @endif
            <h6 class="mt-3 f-14 f-w-600">
                @if (isset(auth()->user()->users_detail))
                    @if (auth()->user()->users_detail->nama_lengkap != null)
                        {{ auth()->user()->users_detail->nama_lengkap }}
                    @else
                        {{ auth()->user()->name }}
                    @endif
                @else
                    {{ auth()->user()->name }}
                @endif
            </h6>
            </a>
            <p class="mb-0 font-roboto">
                @if (isset(auth()->user()->sekolah))
                    @if (auth()->user()->sekolah->nama_sekolah != null)
                        {{ auth()->user()->sekolah->nama_sekolah }}
                    @else
                        {{ auth()->user()->name }}
                    @endif
                @else
                    {{ auth()->user()->name }}
                @endif
            </p>
        </div>
        <nav>
            <div class="main-navbar">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="mainnav">
                    <ul class="nav-menu custom-scrollbar">
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Dashboard </h6>
                            </div>
                        </li>

                        {{-- // jika siswa --}}
                        @if (auth()->user()->role_id == '1')
                            <li><a class="nav-link menu-title" href="{{ route('sekolah.dashboard.index') }}"><i
                                        data-feather="home"></i><span>Dashboard</span></a></li>
                        @endif

                        @if (auth()->user()->role_id == '2')
                            <li><a class="nav-link menu-title" href="{{ route('siswa.dashboard.index') }}"><i
                                        data-feather="home"></i><span>Dashboard</span></a></li>
                        @endif

                        @if (auth()->user()->role_id == '3')
                            <li><a class="nav-link menu-title" href="{{ route('dashboard') }}"><i
                                        data-feather="home"></i><span>Dashboard</span></a></li>
                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Master Data </h6>
                                </div>
                            </li>

                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('admin.data_sekolah.index') }}"><i
                                        data-feather="file-text"></i><span>Data Sekolah</span></a></li>
                            {{-- <li class="dropdown"><a class="nav-link menu-title link-nav" --}}
                            {{-- href="{{ route('admin.sekolah_area.index') }}"><i --}}
                            {{-- data-feather="file-text"></i><span>Sekolah Area</span></a></li> --}}
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('admin.pengumuman.index') }}"><i
                                        data-feather="file-text"></i><span>Pengumuman</span></a></li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Pengaturan</h6>
                                </div>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('admin.jadwal.index') }}"><i
                                        data-feather="file-text"></i><span>Jadwal PPDB</span></a></li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('admin.kontak.index') }}"><i
                                        data-feather="file-text"></i><span>Kontak</span></a></li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('admin.kontrol_jalur.index') }}"><i
                                        data-feather="file-text"></i><span>Kontrol Jalur</span></a></li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('admin.pengumuman.kelulusan.index') }}"><i
                                        data-feather="file-text"></i><span>Pengumuman Kelulusan</span></a></li>


                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Kelola User</h6>
                                </div>
                            </li>
                            <li><a class="nav-link menu-title link-nav" href="{{ route('sekolah.user.index') }}"><i
                                        data-feather="file-text"></i><span>User Sekolah</span></a></li>
                        @endif
                        @if (auth()->user()->role_id == '1')
                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Master Data</h6>
                                </div>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.profil_sekolah.index') }}"><i
                                        data-feather="file-text"></i><span>Profil Sekolah</span></a></li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.daya_tampung.index') }}"><i
                                        data-feather="file-text"></i><span>Daya Tampung</span></a></li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Persyaratan</h6>
                                </div>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.persyaratan.zonasi.index') }}"><i
                                        data-feather="file-text"></i><span>Persyaratan Zonasi</span></a></li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.persyaratan.prestasi.index') }}"><i
                                        data-feather="file-text"></i><span>Persyaratan Prestasi</span></a></li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.persyaratan.afirmasi.index') }}"><i
                                        data-feather="file-text"></i><span>Persyaratan Afirmasi</span></a></li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.persyaratan.mutasi.index') }}"><i
                                        data-feather="file-text"></i><span>Persyaratan Mutasi</span></a></li>



                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Pendaftaran PDB</h6>
                                </div>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"
                                    data-bs-original-title="" title=""><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit">
                                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                                        </path>
                                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                    </svg><span>Zonasi</span>
                                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                                </a>
                                <ul class="nav-submenu menu-content" style="display: none;">
                                    <li><a href="{{ route('admin.zonasi.index') }}" data-bs-original-title=""
                                            title="">Pendaftar</a></li>
                                    <li><a href="{{ route('admin.zonasi.verifikasi.index') }}"
                                            data-bs-original-title="" title="">Peserta Diverifikasi</a></li>
                                    <li><a href="{{ route('admin.zonasi.lulus.index') }}" data-bs-original-title=""
                                            title="">Peserta Lulus</a></li>
                                    <li><a href="{{ route('admin.zonasi.tidak.lulus.index') }}"
                                            data-bs-original-title="" title="">Peserta Tidak Lulus</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"
                                    data-bs-original-title="" title=""><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit">
                                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                                        </path>
                                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                    </svg><span>Prestasi</span>
                                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                                </a>
                                <ul class="nav-submenu menu-content" style="display: none;">
                                    <li><a href="{{ route('admin.prestasi.index') }}" data-bs-original-title=""
                                            title="">Pendaftar</a>
                                    </li>
                                    <li><a href="{{ route('admin.prestasi.verifikasi.index') }}"
                                            data-bs-original-title="" title="">Peserta Diverifikasi</a></li>
                                    <li><a href="{{ route('admin.prestasi.lulus.index') }}" data-bs-original-title=""
                                            title="">Peserta Lulus</a></li>
                                    <li><a href="{{ route('admin.prestasi.tidak.lulus.index') }}"
                                            data-bs-original-title="" title="">Peserta Tidak Lulus</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"
                                    data-bs-original-title="" title=""><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit">
                                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                                        </path>
                                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                    </svg><span>Afirmasi</span>
                                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                                </a>
                                <ul class="nav-submenu menu-content" style="display: none;">
                                    <li><a href="{{ route('admin.afirmasi.index') }}" data-bs-original-title=""
                                            title="">Pendaftar</a>
                                    </li>
                                    <li><a href="{{ route('admin.afirmasi.verifikasi.index') }}"
                                            data-bs-original-title="" title="">Peserta Diverifikasi</a></li>
                                    <li><a href="{{ route('admin.afirmasi.lulus.index') }}" data-bs-original-title=""
                                            title="">Peserta Lulus</a></li>
                                    <li><a href="{{ route('admin.afirmasi.tidak.lulus.index') }}"
                                            data-bs-original-title="" title="">Peserta Tidak Lulus</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"
                                    data-bs-original-title="" title=""><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit">
                                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                                        </path>
                                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                    </svg><span>Mutasi</span>
                                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                                </a>
                                <ul class="nav-submenu menu-content" style="display: none;">
                                    <li><a href="{{ route('admin.mutasi.index') }}" data-bs-original-title=""
                                            title="">Pendaftar</a>
                                    </li>
                                    <li><a href="{{ route('admin.mutasi.verifikasi.index') }}"
                                            data-bs-original-title="" title="">Peserta Diverifikasi</a></li>
                                    <li><a href="{{ route('admin.mutasi.lulus.index') }}" data-bs-original-title=""
                                            title="">Peserta Lulus</a></li>
                                    <li><a href="{{ route('admin.mutasi.tidak.lulus.index') }}"
                                            data-bs-original-title="" title="">Peserta Tidak Lulus</a></li>
                                </ul>
                            </li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Laporan</h6>
                                </div>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.laporan.index') }}"><i
                                        data-feather="file"></i><span>Cetak Laporan</span></a></li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Kelola Operator</h6>
                                </div>
                            </li>
                            @if (auth()->user()->diknas_id == '1')
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('sekolah.operator.index') }}"><i
                                            data-feather="user"></i><span>Operator</span></a></li>
                            @endif
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.profil.index') }}"><i
                                        data-feather="user"></i><span>Profil</span></a></li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Data Siswa</h6>
                                </div>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('sekolah.reset.index') }}">
                                    <i data-feather="user"></i><span>Reset Password</span></a></li>

                        @endif


                        @if (auth()->user()->role_id == '2')
                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Calon Siswa</h6>
                                </div>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title link-nav"
                                    href="{{ route('siswa.profil.index') }}"><i
                                        data-feather="user"></i><span>Profil</span></a></li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Jalur</h6>
                                </div>
                            </li>
                            @php
                                $jalur_zonasi = Kontrol_jalur::where('jenis_sekolah_id', '3')
                                    ->where('jalur', 'zonasi')
                                    ->where('tanggal_buka', '<=', date('Y-m-d'))
                                    ->where('tanggal_tutup', '>=', date('Y-m-d'))
                                    ->get();
                            @endphp
                            @if (count($jalur_zonasi) > 0)
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('siswa.zonasi.index') }}"><i
                                            data-feather="user"></i><span>Zonasi</span></a></li>
                            @endif
                            @php
                                $jalur_afirmasi = Kontrol_jalur::where('jenis_sekolah_id', '3')
                                    ->where('jalur', 'afirmasi')
                                    ->where('tanggal_buka', '<=', date('Y-m-d'))
                                    ->where('tanggal_tutup', '>=', date('Y-m-d'))
                                    ->get();
                            @endphp
                            @if (count($jalur_afirmasi) > 0)
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('siswa.afirmasi.index') }}"><i
                                            data-feather="user"></i><span>Afirmasi</span></a></li>
                            @endif
                            @php
                                $jalur_mutasi = Kontrol_jalur::where('jenis_sekolah_id', '3')
                                    ->where('jalur', 'mutasi')
                                    ->where('tanggal_buka', '<=', date('Y-m-d'))
                                    ->where('tanggal_tutup', '>=', date('Y-m-d'))
                                    ->get();
                            @endphp
                            @if (count($jalur_mutasi) > 0)
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('siswa.mutasi.index') }}"><i
                                            data-feather="user"></i><span>Mutasi</span></a></li>
                            @endif
                            @php
                                $jalur_prestasi = Kontrol_jalur::where('jenis_sekolah_id', '3')
                                    ->where('jalur', 'prestasi')
                                    ->where('tanggal_buka', '<=', date('Y-m-d'))
                                    ->where('tanggal_tutup', '>=', date('Y-m-d'))
                                    ->get();
                            @endphp
                            @if (count($jalur_prestasi) > 0)
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('siswa.prestasi.index') }}"><i
                                            data-feather="user"></i><span>Prestasi</span></a></li>
                            @endif
                        @endif

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
        </nav>
    </header>
    <!-- Page Sidebar Ends-->
</div>
