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

                                        <span class="d-block">Register/Login </span>
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
</div>
