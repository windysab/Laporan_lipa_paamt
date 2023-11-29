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
            <h1>All Users</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Users</a></div>
                <div class="breadcrumb-item">All Users</div>
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
                            <h4>All Users</h4>
                            {{-- <div class="section-header-button">
                                <a href="{{ route('user.create') }}" class="btn btn-primary">New User</a>
                            </div> --}}
                            <div class="card-header">


                                <form method="POST" , action="{{ route('perkara-masuk.index') }}">
                                    Kecamatan :
                                    <select name="kecamatan" required="">
                                        <option value="Amuntai Selatan" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Amuntai Selatan' ) ? 'selected' : '' ; ?>>Amuntai
                                            Selatan</option>
                                        <option value="Amuntai Tengah" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Amuntai Tengah' ) ? 'selected' : '' ; ?>>Amuntai
                                            Tengah</option>
                                        <option value="Amuntai Utara" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Amuntai Utara' ) ? 'selected' : '' ; ?>>Amuntai Utara
                                        </option>
                                        <option value="Babirik" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Babirik' ) ? 'selected' : '' ; ?>>Babirik</option>
                                        <option value="Banjang" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Banjang' ) ? 'selected' : '' ; ?>>Banjang</option>
                                        <option value="Danau Panggang" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Danau Panggang' ) ? 'selected' : '' ; ?>>Danau
                                            Panggang</option>
                                        <option value="Haur Gading" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Haur Gading' ) ? 'selected' : '' ; ?>>Haur Gading
                                        </option>
                                        <option value="Paminggir" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Paminggir' ) ? 'selected' : '' ; ?>>Paminggir
                                        </option>
                                        <option value="Sungai Pandan" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Sungai Pandan' ) ? 'selected' : '' ; ?>>Sungai Pandan
                                        </option>
                                        <option value="Sungai Tabukan" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='Sungai Tabukan' ) ? 'selected' : '' ; ?>>Sungai
                                            Tabukan</option>

                                    </select>
                                    Bulan :
                                    <select name="lap_bulan" required="">
                                        <option value="01" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='01' ) ? 'selected' : '' ; ?>>Januari</option>
                                        <option value="02" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='02' ) ? 'selected' : '' ; ?>>Februari</option>
                                        <option value="03" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='03' ) ? 'selected' : '' ; ?>>Maret</option>
                                        <option value="04" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='04' ) ? 'selected' : '' ; ?>>April</option>
                                        <option value="05" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='05' ) ? 'selected' : '' ; ?>>Mei</option>
                                        <option value="06" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='06' ) ? 'selected' : '' ; ?>>Juni</option>
                                        <option value="07" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='07' ) ? 'selected' : '' ; ?>>Juli</option>
                                        <option value="08" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='08' ) ? 'selected' : '' ; ?>>Agustus</option>
                                        <option value="09" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='09' ) ? 'selected' : '' ; ?>>September</option>
                                        <option value="10" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='10' ) ? 'selected' : '' ; ?>>Oktober</option>
                                        <option value="11" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='11' ) ? 'selected' : '' ; ?>>Nopember</option>
                                        <option value="12" <?php echo (isset($_POST['lap_bulan']) &&
                                            $_POST['lap_bulan']==='12' ) ? 'selected' : '' ; ?>>Desember</option>
                                    </select>
                                    Tahun :
                                    <select name="kecamatan" required="">
                                        <option value="2016" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2016' ) ? 'selected' : '' ; ?>>2016</option>
                                        <option value="2017" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2017' ) ? 'selected' : '' ; ?>>2017</option>
                                        <option value="2018" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2018' ) ? 'selected' : '' ; ?>>2018</option>
                                        <option value="2019" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2019' ) ? 'selected' : '' ; ?>>2019</option>
                                        <option value="2020" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2020' ) ? 'selected' : '' ; ?>>2020</option>
                                        <option value="2021" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2021' ) ? 'selected' : '' ; ?>>2021</option>
                                        <option value="2022" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2022' ) ? 'selected' : '' ; ?>>2022</option>
                                        <option value="2023" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2023' ) ? 'selected' : '' ; ?>>2023</option>
                                        <option value="2024" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2024' ) ? 'selected' : '' ; ?>>2024</option>
                                        <option value="2025" <?php echo (isset($_POST['kecamatan']) &&
                                            $_POST['kecamatan']==='2025' ) ? 'selected' : '' ; ?>>2025</option>
                                    </select>
                                    <input class="btn btn-primary" type="submit" name="btn" value="Tampilkan" />
                            </div>
                        </div>
                        <div class="card-body">


                            <div class="float-right">
                                <form method="GET" , action="{{ route('perkara-masuk.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="name">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>

                                        <th>Nomor Perkara</th>
                                        <th>tgl_pendaftran</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>

                                    </tr>
                                    @foreach ($perkaras as $perkara)
                                    <tr>
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
                            {{-- <div class="float-right">
                                {{ $perkaras->withQueryString()->links() }}
                            </div> --}}
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