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
                                <form method="GET" action="{{ route('perkara-masuk-blg.index') }}">
                                    @csrf
                                    Kecamatan :
                                    <select name="alamat" required="">
                                        <option value="Paringin" {{ old('alamat')=='Paringin' ? 'selected' : '' }}>
                                            Paringin</option>
                                        <option value="Paringin Selatan" {{ old('alamat')=='Paringin Selatan'
                                            ? 'selected' : '' }}>Paringin Selatan</option>
                                        <option value="Tebing Tinggi" {{ old('alamat')=='Tebing Tinggi' ? 'selected'
                                            : '' }}>Tebing Tinggi</option>
                                        <option value="Awayan" {{ old('alamat')=='Awayan' ? 'selected' : '' }}>Awayan
                                        </option>
                                        <option value="Batu Mandi" {{ old('alamat')=='Batu Mandi' ? 'selected' : '' }}>
                                            Batu Mandi</option>
                                        <option value="Halong" {{ old('alamat')=='Halong' ? 'selected' : '' }}>Halong
                                        </option>
                                        <option value="Juai" {{ old('alamat')=='Juai' ? 'selected' : '' }}>Juai</option>



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
                                <form method="GET" action="{{ route('perkara-masuk-blg.index') }}">
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
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Perkara</th>
                                        <th>tgl_pendaftran</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>

                                    </tr>
                                    @foreach ($perkaras as $perkara)
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        <td>{{ $loop->iteration + $perkaras->firstItem() - 1 }}</td>

                                        <td>{{ $perkara->nomor_perkara }}</td>
                                        <td>{{ $perkara->tanggal_pendaftaran }}</td>
                                        <td>{{ $perkara->nama }}</td>
                                        <td>{{ $perkara->alamat}}</td>
                                        <td>
                                            {{-- <div class="d-flex justify-content-center">
                                                <a href='{{ route(' user.edit', $user->id) }}'
                                                    class="btn btn-sm btn-info btn-icon">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a> --}}

                                                {{-- <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                    class="ml-2">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                        <i class="fas fa-times"></i> Delete
                                                    </button>
                                                </form> --}}
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach



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
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush