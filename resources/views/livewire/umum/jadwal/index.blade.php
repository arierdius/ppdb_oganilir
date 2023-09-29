@php
    use App\Models\Admin\Jadwal;
    $jadwal = Jadwal::get();
@endphp



<div class="new-add-school mt-5">

        <!-- prakata bupati  -->
        <div class="container" id="jadwal">
            {{-- @dd($jadwal) --}}
            <center class="mb-5">
                <h1>JADWAL PELAKSANAAN PPDB</h1>
            </center>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu }}</td>
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
