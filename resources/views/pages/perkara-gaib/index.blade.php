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
                            <h4>Data Perkara Gaib</h4>
                            <div class="card-header">
                                <form method="GET" action="{{ route('perkara-gaib.index') }}">
                                    @csrf
                                    {{-- Kecamatan :
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
                                    </select> --}}

                                    {{-- <select name="alamat" required>
                                        @foreach($alamats as $alamat)
                                        <option value="{{ $alamat }}" {{ old('alamat')==$alamat ? 'selected' : '' }}>{{
                                            $alamat }}</option>
                                        @endforeach
                                    </select> --}}
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
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Perkara</th>
                                            <th>Majelis Hakim Nama</th>
                                            <th>Panitera Pengganti Text</th>
                                            <th>Tanggal Pendaftaran</th>
                                            <th>Penetapan Majelis Hakim</th>
                                            <th>Penetapan Hari Sidang</th>
                                            <th>Sidang Pertama</th>
                                            <th>Tanggal Putusan</th>
                                            <th>Status Putusan Nama</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomor_perkara }}</td>
                                            {{-- <td>{{ $item->majelis_hakim_text }}</td> --}}
                                            <td>{!! nl2br(e(str_replace('</br>', ', ', $item->majelis_hakim_nama))) !!}
                                            </td>
                                            <td>{{ $item->panitera_pengganti_text }}</td>
                                            <td>{{ $item->tanggal_pendaftaran }}</td>
                                            <td>{{ $item->penetapan_majelis_hakim }}</td>
                                            <td>{{ $item->penetapan_hari_sidang }}</td>
                                            <td>{{ $item->sidang_pertama }}</td>
                                            <td>{{ $item->tanggal_putusan }}</td>
                                            <td>{{ $item->status_putusan_nama }}</td>
                                            {{-- <td>{{ $item->alamat }}</td> --}}
                                            <td>{{ Str::limit($item->alamat, 50) }}</td>
                                        </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $result->links() }}
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
