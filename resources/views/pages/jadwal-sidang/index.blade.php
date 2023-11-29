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
                <div class="breadcrumb-item">Jadwal Sidang</div>
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

                            <p>Tanggal Sidang: {{ $tanggal_sidang }}</p>
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
                                <form method="GET" action="{{ route('jadwal-sidang.index') }}" class="form-inline">
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
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table border="1">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            {{-- <th>ID Perkara</th> --}}
                                            {{-- <th>ID Alur Perkara</th> --}}
                                            <th>No Perkara</th>
                                            <th>Ruang Sidang</th>
                                            <th>Jam Sidang</th>
                                            <th>Agenda Sidang</th>
                                            {{-- <th>Pihak1</th>
                                            <th>Pihak2</th> --}}
                                            <th>Penggugat</th>
                                            <th>Tergugat</th>
                                            {{-- <th>Turut Tergugat</th> --}}
                                            <th>Nama Hakim</th>
                                            <th>Nama Panitera</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwalSidangs as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $item->IDPerkara }}</td> --}}
                                            {{-- <td>{{ $item->IDAlurPerkara }}</td> --}}
                                            <td>{{ $item->noPerkara }}</td>
                                            <td>{{ $item->ruangSidang }}</td>
                                            <td>{{ $item->jamSidang }}</td>
                                            <td>{{ $item->agendaSidang }}</td>
                                            {{-- <td>{{ $item->pihak1 }}</td>
                                            <td>{{ $item->pihak2 }}</td> --}}
                                            <td>{{ $item->penggugat }}</td>
                                            <td>{{ $item->tergugat }}</td>
                                            {{-- <td>{{ $item->turut_tergugat }}</td> --}}
                                            <td>{!! $item->namaHakim !!}</td>
                                            <td>{!! $item->namaPanitera !!}</td>

                                            {{-- <td colspan="5">Tidak ada jadwal sidang yang tersedia.</td> --}}
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
