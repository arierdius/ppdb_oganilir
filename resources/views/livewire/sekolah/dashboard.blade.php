<div>
    <!-- Container-fluid starts-->
    <div class="container-fluid general-widget">
        <div class="row">
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="database"></i></div>
                            <div class="media-body"><span class="m-0">Seluruh Pendaftar</span>
                                <h4 class="mb-0 counter">{{ count($total_pendaftar) }}</h4><i class="icon-bg"
                                    data-feather="database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i>
                            </div>
                            <div class="media-body"><span class="m-0">ZONASI</span>
                                <h4 class="mb-0 counter">{{ count($data_zonasi_diterima) }}</h4><i class="icon-bg"
                                    data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i>
                            </div>
                            <div class="media-body"><span class="m-0">PRESTASI</span>
                                <h4 class="mb-0 counter">{{ count($data_prestasi_diterima) }}</h4><i class="icon-bg"
                                    data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i>
                            </div>
                            <div class="media-body"><span class="m-0">AFIRMASI</span>
                                <h4 class="mb-0 counter">{{ count($data_afirmasi_diterima) }}</h4><i class="icon-bg"
                                    data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i>
                            </div>
                            <div class="media-body"><span class="m-0">MUTASI</span>
                                <h4 class="mb-0 counter">{{ count($data_mutasi_diterima) }}</h4><i class="icon-bg"
                                    data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i>
                            </div>
                            <div class="media-body"><span class="m-0">Operator</span>
                                <h4 class="mb-0 counter"></h4><i class="icon-bg" data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h5>Pengumuman</h5>
                            <table class="table table-striped display" id="basic-1" style="font-size:12px;">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">Tanggal</th>
                                        <th>Pengumuman</th>
                                    </tr>
                                    @forelse ($pengumuman as $key_pengumuman)
                                        <tr>
                                            <td>
                                                {{ date('d M Y', strtotime($key_pengumuman->created_at)) }}
                                            <td>
                                                {{ $key_pengumuman->pengumuman }}
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

</div>
