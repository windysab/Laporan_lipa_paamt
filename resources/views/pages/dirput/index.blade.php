@extends('layouts.app')

@section('title', 'Perkara')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Include Bootstrap Datepicker CSS -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengadilan Agama Amuntai Kelas IB</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Direktori Putusan</div>
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
                            <h4>Jadwal Sidang</h4>

                            {{-- <p>Tanggal Sidang: {{ $tanggal_sidang }}</p> --}}
                            {{-- Pesan error jika tanggal sidang tidak valid atau tidak diberikan --}}
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif

                            {{-- Menampilkan tanggal sidang --}}

                            {{-- <div class="card-header">
                                <form method="GET" action="{{ route('jadwal-sidang.index') }}">
                                    <div class="form-group">
                                        <label for="tanggal_sidang">Tanggal Sidang:</label>
                                        <div class="input-group date">
                                            <input type="text" name="tanggal_sidang" class="form-control datepicker"
                                                id="tanggal_sidang">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </form>

                            </div> --}}

                            <div class="card-header">
                                <form method="GET" action="{{ route('dirput.index') }}" class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="nomor_perkara" class="mr-2">Nomor Perkara:</label>
                                        <input type="text" name="nomor_perkara" class="form-control" id="nomor_perkara">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                </form>
                            </div>


                                {{-- <form method="GET" action="{{ route('jadwal-sidang.index') }}" class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="tanggal_sidang" class="mr-2">Tanggal Sidang:</label>
                                        <div class="input-group date mr-2">
                                            <input type="text" name="tanggal_sidang" class="form-control datepicker"
                                                id="tanggal_sidang">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                                    </div>
                                </form> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>No Perkara</th>
                                            <th>tanggal_pendaftaran</th>
                                            <th>tanggal_diputus</th>
                                            <th>para_pihak</th>

                                            <th>catatan amar</th>
                                            <th>Hakim Ketua</th>
                                            <th>Hakim Anggota</th>
                                            <th>Panitera</th>
                                            <th>BHT</th>
                                            <th>File Putusan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($perkaras->count() == 0)
                                        {{-- <input type="text" name="nomor_perkara" class="form-control" id="nomor_perkara"> --}}

                                        <tr>
                                            <td colspan="12" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endif

                                        @foreach($perkaras as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomor_perkara }}</td>
                                            <td>{{ $item->tanggal_register }}</td>
                                            <td>{{ $item->tanggal_diputus }}</td>
                                            <td>{!! str_replace('<br />', ', ', $item->para_pihak) !!}</td>
                                            <td>{!! str_replace('<br />', ', ',$item->catatan_amar) !!}</td>
                                            <td>{{ $item->hakim_ketua }}</td>
                                            <td>{!! str_replace('<br />', ', ',$item->hakim_anggota)  !!}</td>
                                            <td>{{ $item->panitera}}</td>
                                            <td>{{ $item->bht }}</td>
                                            <td>
                                                @if($item->file_putusan)
                                                <a href="{{ asset('storage/' . $item->file_putusan) }}"
                                                    class="btn btn-info btn-sm">Lihat</a>
                                                @else
                                                <span class="badge badge-danger">Tidak ada file</span>
                                                @endif
                                            </td>

                                            {{-- <td>
                                                <a href="{{ route('dirput.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form method="POST" action="{{ route('dirput.destroy', $item->id) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                                </form>
                                            </td> --}}


                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="float-right">
                                {{ $jadwalSidangs ->links() }}
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
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Include Bootstrap JS and Bootstrap Datepicker JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Format date sesuai dengan yang digunakan pada database
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
@endpush
