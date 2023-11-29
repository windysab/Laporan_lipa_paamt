@extends('layouts.app')

@section('title', 'Perkara')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengadilan Agama Amuntai Kelas IB</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Data</a></div>
                <div class="breadcrumb-item">LIPA 1</div>
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data LIPA 1</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('perkara-lipa1.index') }}" class="form-inline">

                                <div class="form-group mb-2">
                                    <label for="jenis_perkara" class="mr-2">Jenis Perkara:</label>
                                    <select name="jenis_perkara" class="form-control" required>
                                        @foreach($jenis_perkara as $key => $value)
                                        <option value="{{ $key }}" {{ old('jenis_perkara')==$key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="bulan" class="mr-2">Bulan:</label>
                                    <select name="bulan" class="form-control" required>
                                        @foreach($bulan as $key => $value)
                                        <option value="{{ $key }}" {{ old('bulan')==$key ? 'selected' : (date('m')==$key
                                            ? 'selected' : '' ) }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="tahun" class="mr-2">Tahun:</label>
                                    <select name="tahun" class="form-control" required>
                                        @foreach($tahun as $thn)
                                        <option value="{{ $thn }}" {{ old('tahun')==$thn ? 'selected' : (date('Y')==$thn
                                            ? 'selected' : '' ) }}>
                                            {{ $thn }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-primary mb-2" type="submit" name="btn">Tampilkan</button>
                            </form>

                            @if(isset($request))
                            <p class="mt-3"
                                style="font-size: 14px; font-weight: bold; color: #000; text-align: center;">
                                Jenis Perkara: {{ isset($jenis_perkara[$request->jenis_perkara]) ?
                                $jenis_perkara[$request->jenis_perkara] : '' }}<br>

                                Bulan: {{ isset($bulan[$request->bulan]) ? $bulan[$request->bulan] : '' }} {{
                                $request->tahun }}

                            </p>
                            @endif

                        </div>



                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Perkara</th>
                                    <th>Kode Perkara</th>
                                    <th>Majelis Hakim Nama</th>
                                    <th>Panitera Pengganti Text</th>
                                    <th>Tanggal Pendaftaran</th>
                                    <th>Penetapan Majelis Hakim</th>
                                    <th>Penetapan Hari Sidang</th>
                                    <th>Sidang Pertama</th>
                                    <th>Tanggal Putusan</th>
                                    <th>Status Putusan</th>
                                    <th>Status Pekerjaan</th>
                                    <th>Keterangan</th>
                                    <th>alamat gaib</th>
                                    <th>prodeo</th>
                                    <th>perkara ecourt</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($result as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nomor_perkara }}</td>
                                    <td>{{ $item->jenis_perkara_nama }}</td>
                                    <td>{!! nl2br(e(str_replace('</br>', ', ', $item->majelis_hakim_nama))) !!}
                                    </td>
                                    <td>{{ $item->panitera_pengganti_text }}</td>
                                    <td>{{ $item->tanggal_pendaftaran }}</td>
                                    <td>{{ $item->penetapan_majelis_hakim }}</td>
                                    <td>{{ $item->penetapan_hari_sidang }}</td>
                                    <td>{{ $item->sidang_pertama }}</td>
                                    <td>{{ $item->tanggal_putusan }}</td>
                                    {{-- <td>
                                        <?php
                                        // Misalkan $item adalah objek atau array yang berisi data, dan $tanggal_putusan adalah tanggal putusan yang diinginkan.
                                        $tanggal_hasil = $item->tanggal_putusan;  // Ganti ini dengan atribut atau variabel yang sesuai.

                                        // Tanggal putusan yang diinginkan
                                        $tanggal_putusan = $item->sidang_pertama;  // Ganti ini dengan atribut atau variabel yang sesuai.



                                        // Periksa apakah tanggal hasil lebih besar dari tanggal putusan
                                        if ($tanggal_hasil > $tanggal_putusan) {
                                            echo "Data tidak valid";
                                        } else {
                                            echo $tanggal_hasil;
                                        }
                                        ?>
                                    </td> --}}




                                    <td>{{ $item->pekerjaan }}</td>
                                    <td>
                                        @if (strpos($item->pekerjaan, 'PNS') !== false || strpos($item->pekerjaan,
                                        'Pegawai Negeri Sipil') !== false)
                                        * *
                                        @elseif (strpos($item->pekerjaan, 'Pensiunan') !== false)
                                        #
                                        @else
                                        {{ '' }}
                                        @endif
                                    </td>
                                    <td>{{ $item->alamat_pihak2 }}</td>
                                    <td>
                                        <?php echo ($item->prodeo == 1) ? '#' : ''; ?>
                                    </td>
                                    <td>{{ $item->email_pihak1 }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data yang tersedia</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="float-right">
                        {{ $result->links() }}
                    </div> --}}

                </div>
            </div>
        </div>
</div>
</div>
</section>
</div>

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
