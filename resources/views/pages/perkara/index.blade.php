@extends('layouts.app')

@section('title', 'Users')

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
                <div class="breadcrumb-item">Perkara Masuk</div>
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
                            <h4>Data Perkara perkecamatan</h4>
                            {{-- <div class="section-header-button">
                                <a href="{{ route('user.create') }}" class="btn btn-primary">New User</a>
                            </div> --}}
                            <div class="card-header">
                                <form method="GET" action="{{ route('perkara.index') }}">
                                    @csrf
                                    Kecamatan :
                                    <select name="alamat" required="">
                                        <option value="Amuntai Selatan" {{ old('alamat')=='Amuntai Selatan' ? 'selected'
                                            : '' }}>Amuntai Selatan</option>
                                        <option value="Amuntai Tengah" {{ old('alamat')=='Amuntai Tengah' ? 'selected'
                                            : '' }}>Amuntai Tengah</option>
                                        <option value="Amuntai Utara" {{ old('alamat')=='Amuntai Utara' ? 'selected'
                                            : '' }}>Amuntai Utara</option>
                                        <option value="Babirik" {{ old('alamat')=='Babirik' ? 'selected' : '' }}>Babirik
                                        </option>
                                        <option value="Banjang" {{ old('alamat')=='Banjang' ? 'selected' : '' }}>Banjang
                                        </option>
                                        <option value="Danau Panggang" {{ old('alamat')=='Danau Panggang' ? 'selected'
                                            : '' }}>Danau Panggang</option>
                                        <option value="Haur Gading" {{ old('alamat')=='Haur Gading' ? 'selected' : ''
                                            }}>Haur Gading</option>
                                        <option value="Paminggir" {{ old('alamat')=='Paminggir' ? 'selected' : '' }}>
                                            Paminggir</option>
                                        <option value="Sungai Pandan" {{ old('alamat')=='Sungai Pandan' ? 'selected'
                                            : '' }}>Sungai Pandan</option>
                                        <option value="Sungai Tabukan" {{ old('alamat')=='Sungai Tabukan' ? 'selected'
                                            : '' }}>Sungai Tabukan</option>
                                    </select>

                                    {{-- <select name="alamat" required>
                                        @foreach($alamats as $alamat)
                                        <option value="{{ $alamat }}" {{ old('alamat')==$alamat ? 'selected' : '' }}>{{
                                            $alamat }}</option>
                                        @endforeach
                                    </select> --}}
                                    Bulan :
                                    <select name="bulan" required>
                                        @foreach($bulan as $key => $value)
                                        <option value="{{ $key }}" {{ old('bulan')==$key ? 'selected' : '' }}>{{
                                            $value }}</option>
                                        @endforeach
                                    </select>
                                    Tahun :
                                    <select name="tahun" required>
                                        @foreach($tahun as $thn)
                                        <option value="{{ $thn }}" {{ old('tahun')==$thn ? 'selected' : '' }}>{{
                                            $thn }}</option>
                                        @endforeach
                                    </select>
                                    <input class="btn btn-primary" type="submit" name="btn" value="Tampilkan" />
                                </form>

                            </div>
                        </div>
                        <div class="card-body">

                            <div class="float-right">
                                <form method="GET" action="{{ route('perkara.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="cari"
                                            value="{{ old('cari') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Perkara</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Pendaftaran</th>
                                            <th>Tanggal Putusan</th>
                                            <th>Tgl Akta Cerai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($result as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomor_perkara }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->tanggal_pendaftaran }}</td>

                                            <td>{{ $item->tanggal_putusan }}</td>
                                            <td>{{ $item->tgl_akta_cerai }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $result->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush