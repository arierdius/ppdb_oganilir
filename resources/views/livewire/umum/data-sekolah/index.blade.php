@php
    use App\Models\Umum\DataSekolah;
    $data_sekolah = DataSekolah::where('jenis_sekolah_id', '3')
        ->where('status_sekolah', 'negeri')
        ->get();
    // dd($data_sekolah);
@endphp

<div class="new-add-school" >

    <!-- prakata bupati  -->
    <div class="container" id="jadwal" >
        {{-- @dd($jadwal) --}}
        <div class="mb-5 text-center">
            <h1>DAFTAR SEKOLAH SMPN KAB OGAN ILIR</h1>
        </div>
        <table class="table mt-5">
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
                        <td> <a style="text-decoration: none;" href="{{$item_sekolah->surel}}" target="_blank"> {{ $item_sekolah->nama_sekolah }}</a></td>
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
