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
                <div class="breadcrumb-item">Perkara Dispensasi Kawin</div>
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
                            <h4>Data Perkara Dispensasi</h4>
                            <div class="card-header">
                                <form method="GET" action="{{ route('perkara-diska.index') }}">
                                    

                                    Bulan:
                                    <select name="bulan" required>
                                        @foreach($bulan as $key => $value)
                                        <option value="{{ $key }}" {{ old('bulan')==$key ? 'selected' :
                                            ((date('m')==$key) ? 'selected' : '' ) }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    Tahun:
                                    <select name="tahun" required>
                                        @foreach($tahun as $thn)
                                        <option value="{{ $thn }}" {{ old('tahun')==$thn ? 'selected' :
                                            ((date('Y')==$thn) ? 'selected' : '' )}}>{{ $thn }}</option>
                                        @endforeach
                                    </select>
                                    <input class="btn btn-primary" type="submit" name="btn" value="Tampilkan" />
                                </form>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nomor Perkara</th>
                                            <th>Tanggal Pendaftaran</th>
                                            <th>Tanggal Putus</th>
                                            <th>Jenis Putusan</th>
                                            <th>Usia L</th>
                                            <th>Usia P</th>
                                            <th>Alasan Pengajuan</th>
                                            <th>Keterangan Sidang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($perkaras as $perkara)
                                        <tr>
                                            <td>{{ $loop->iteration + $perkaras->firstItem() - 1 }}</td>
                                            <td>{{ $perkara->nomor_perkara }}</td>
                                            <td>{{ $perkara->tanggal_pendaftaran}}</td>
                                            <td>{{ $perkara->tanggal_putusan}}</td>
                                            <td>{{ $perkara->jenis_putusan}}</td>
                                            <td>{{ $perkara->jenis_putusan}}</td>
                                            <td>{{ $perkara->jenis_putusan}}</td>
                                            <td>{{ $perkara->alasan_nikah}}</td>
                                            <td>{{ $perkara->tanggal_sidang }}</td>
                                            {{-- <td>{{
                                                \Carbon\Carbon::parse($perkara->tanggal_pendaftaran)->format('d/m/Y')
                                                }}</td> --}}
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data yang tersedia</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $perkaras->withQueryString()->links() }}
                            </div>
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
