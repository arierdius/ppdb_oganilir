@php
    use App\Models\Umum\DataSekolah;
    $data_sekolah = DataSekolah::where('jenis_sekolah_id', '3')
        ->where('status_sekolah', 'negeri')
        ->get();
    // dd($data_sekolah);
@endphp
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

                <img src="{{ asset('assets_umum/images/banner-pic2.jpg') }}"  style="width:100%;" alt="banner-1">

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

                <img src="{{ asset('assets_umum/images/banner-pic.jpg') }}"  style="width:100%;" alt="banner-1">

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

{{-- <div class="medi-services">

    <div class="container">

        <div class="row row-cols-1 row-cols-md-4">

            <!-- <a href="awdawd.html"> -->

            <div class="col">
                <div class="comon-quick">
                    <div class="text-center">
                        <figure> <img src="{{ asset('assets_umum/images/creative.png') }}" alt="mv" />
                        </figure>
                        <h4>ZONASI</h4>
                    </div>
                </div>
            </div>
            <!-- </a> -->

            <div class="col">
                <div class="comon-quick">
                    <div class="text-center">
                        <figure> <img src="{{ asset('assets_umum/images/creative.png') }}" alt="mv" />
                        </figure>
                        <h4>PRESTASI</h4>
                    </div>
                </div>
            </div>
            <!-- </a> -->

            <div class="col">
                <div class="comon-quick">
                    <div class="text-center">
                        <figure> <img src="{{ asset('assets_umum/images/creative.png') }}" alt="mv" />
                        </figure>
                        <h4>AFIRMASI</h4>
                    </div>
                </div>
            </div>
            <!-- </a> -->
            <div class="col">
                <div class="comon-quick">
                    <div class="text-center">
                        <figure> <img src="{{ asset('assets_umum/images/creative.png') }}" alt="mv" />
                        </figure>
                        <h4>MUTASI</h4>
                    </div>
                </div>
            </div>



        </div>



    </div>



</div> --}}


<div class="new-add-school mt-5">

    <!-- prakata bupati  -->
    <div class="container" id="jadwal" style="margin-bottom: 60px;">
        {{-- @dd($jadwal) --}}
        <center class="mb-5">
            <h1>DAFTAR SEKOLAH SMPN KAB OGAN ILIR</h1>
        </center>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Npsn</th>
                    <th>Nama Sekolah</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Kepala Sekolah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_sekolah as $item_sekolah)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item_sekolah->npsn }}</td>
                        <td> <a href="{{$item_sekolah->surel}}" target="_blank"> {{ $item_sekolah->nama_sekolah }}</a></td>
                        <td>{{ $item_sekolah->alamat }}</td>
                        <td>{{ $item_sekolah->telepon }}</td>
                        <td>{{ $item_sekolah->kepala_sekolah }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>



    {{-- <div class="kite">

        <div class="tail"></div>

    </div> --}}



</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log('aa')
        });
    </script>
@endpush
