<div>

    <header>

        <div class="top-head">

            <div class="container">

                <div class="top-menu">

                    <div class="row">

                        <div class="col-lg-5">

                            <a href="{{ route('umum.dashboard.index') }}"> <img src="{{ asset('assets_umum/images/logo.png') }}" alt="pic"
                                    style="max-height: 80px;" /> </a>

                        </div>

                        <div class="col-lg-7">

                            <ul class="contact-top list-unstyled">

                                <li>

                                    <span class="d-block"> <i class="bi bi-telephone-forward"></i> Nomor Telepon </span>

                                    <span class="d-block"> {{ $kontak->telp }} </span>

                                </li>

                                <li>

                                    <span class="d-block"> <i class="bi bi-envelope"></i> Email

                                    </span>

                                    <span class="d-block"> {{ strtolower($kontak->email) }} </span>

                                </li>

                                <li>
                                    <a href="{{ route('auth.login.index') }}" class="log-hed-btn">
                                        <span class="d-block"> <i class="bi bi-people"></i> Siswa </span>

                                        <span class="d-block">Daftar/Login </span>
                                    </a>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>



            </div>

            <div class="mn-head">

                <div class="container">

                    <nav class="navbar navbar-expand-lg navbar-light">

                        <a class="navbar-brand d-block d-lg-none" href="#">

                            Menu

                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">

                            <span class="navbar-toggler-icon"></span>

                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">

                                <li class="nav-item active">

                                    <a class="nav-link" aria-current="page" href="{{ route('umum.dashboard.index') }}">Home</a>

                                </li>



                                <li class="nav-item ">

                                    <a class="nav-link" aria-current="page" href="{{ route('umum.data-sekolah.index') }}">Data Sekolah</a>

                                </li>



                                <li class="nav-item">

                                    <a class="nav-link" href="{{ route('umum.jadwal.index') }}"> Jadwal </a>

                                </li>


                                <li class="nav-item d-block d-md-none">

                                    <a class="nav-link" href="{{ route('auth.login.index') }}"> Daftar / Login </a>

                                </li>

                                {{-- <li class="nav-item">

                                    <a class="nav-link" href="recruitments.html">PSD</a>

                                </li>


                                <li class="nav-item">

                                    <a class="nav-link" href="contact.html" tabindex="-1" aria-disabled="true">

                                        Kontak

                                    </a>

                                </li> --}}

                            </ul>

                        </div>

                    </nav>

                </div>

            </div>

        </div>



    </header>

    <div class="banner-part d-grid align-content-center">

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-indicators d-lg-none">

                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>

                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>

                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>

            </div>

            <div class="carousel-inner">

                <div class="carousel-item active">

                    <img src="{{ asset('assets_umum/images/banner_pic3.png') }}" alt="banner-1">


                    {{-- @dd($kontak->telp) --}}
                    {{-- <div class="carousel-caption">

                        <div class="container">

                            <h1> <span> Kabupaten Ogan Ilir </span>

                                <span class="d-block"> Penerimaan <b> Peserta </b> </span>

                                <span class="d-block"> Didik </span>

                            </h1>

                            <p>Tahun Pelajaran 2023/2024</p>

                            <div class="d-flex">

                                <a href="#" class="btn book-bn-comon btn btn-info"> Discover more

                                    <i class="fas fa-paper-plane"></i> </a>



                            </div>



                        </div>

                    </div> --}}



                </div>

                <div class="carousel-item">

                    <img src="{{ asset('assets_umum/images/banner-pic2.jpg') }}"  alt="banner-1">

                    <div class="carousel-caption">

                        {{-- <div class="container">

                            <h1> <span> Zonasi, Afirmasi, Perpindahan Orang Tua, <br> Prestasi </span>

                                <span class="d-block">Terpusat </b> </span>


                            </h1>

                            <p>Kapanpun dan Dimanapun, Cepat, Realtime dan Transparan.</p>


                        </div> --}}

                    </div>

                </div>
                <div class="carousel-item">

                    <img src="{{ asset('assets_umum/images/banner-pic.jpg') }}"  alt="banner-1">

                    <div class="carousel-caption">

                        {{-- <div class="container">

                            <h1> <span> Zonasi, Afirmasi, Perpindahan Orang Tua, <br> Prestasi </span>

                                <span class="d-block">Terpusat </b> </span>


                            </h1>

                            <p>Kapanpun dan Dimanapun, Cepat, Realtime dan Transparan.</p>


                        </div> --}}

                    </div>

                </div>



            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">

                <i class="bi bi-chevron-left"></i>

            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">

                <i class="bi bi-chevron-right"></i>

            </button>

        </div>



    </div>
</div>
