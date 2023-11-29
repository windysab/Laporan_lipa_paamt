<?php

namespace App\Http\Controllers;

use App\Models\PerkaraMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerkaraMasukControllerBlg extends Controller
{

    /**
     * Display a listing of the resource.
     */


    // public function index()
    // {



    //     $perkaras = DB::table('perkara')
    //         ->leftJoin('perkara_pihak1', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
    //         ->leftJoin('perkara_putusan', 'perkara.perkara_id', '=', 'perkara_putusan.perkara_id')
    //         ->select('perkara.nomor_perkara', 'perkara.tanggal_pendaftaran', 'perkara_pihak1.nama', 'perkara_pihak1.alamat', 'perkara_putusan.tanggal_putusan')
    //         ->whereYear('tanggal_pendaftaran', '=', 2021)
    //         ->whereMonth('tanggal_pendaftaran', '=', 1)
    //         ->where('perkara_pihak1.urutan', '=', 1)
    //         ->where('perkara_pihak1.alamat', 'like', '%PAMINGGIR%')
    //         ->get();

    //     // return view('perkara.index', compact('perkara'));
    //     return view('pages.perkara-masuk.index', compact('perkaras'));
    // }
    // public function index()
    // {
    //     $perkaras = DB::table('perkara')
    //         ->leftJoin('perkara_pihak1', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
    //         ->leftJoin('perkara_putusan', 'perkara.perkara_id', '=', 'perkara_putusan.perkara_id')
    //         ->select('perkara.nomor_perkara', 'perkara.tanggal_pendaftaran', 'perkara_pihak1.nama', 'perkara_pihak1.alamat', 'perkara_putusan.tanggal_putusan')
    //         ->whereYear('tanggal_pendaftaran', '=', 2021)
    //         ->whereMonth('tanggal_pendaftaran', '=', 1)
    //         ->where('perkara_pihak1.urutan', '=', 1)
    //         ->where('perkara_pihak1.alamat', 'like', '%amuntai selatan%')
    //         ->get();

    //     $kecamatans = DB::table('perkara_pihak1')->select('alamat')->pluck('alamat');
    //     $bulan = [
    //         "01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei",
    //         "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September",
    //         "10" => "Oktober", "11" => "Nopember", "12" => "Desember"
    //     ];

    //     $currentYear = date('Y');
    //     $tahun = range($currentYear - 5, $currentYear + 5);

    //     return view('pages.perkara-masuk.index', compact('perkaras', 'kecamatans', 'bulan', 'tahun'));
    // }


    public function index(Request $request)
    {
        //Kabupaten Balangan
        $validKecamatan = ['Paringin', 'Paringin Selatan', 'Juai', 'Halong', 'Awayan', 'Batu Licin', 'Lampihong', 'Paringin Utara', 'Tebing Tinggi', 'Batu Mandi', 'Juai'];

        // $validKecamatan = ['Batu Mandi', 'Paringin Selatan', ];
        $defaultKecamatan = $validKecamatan[0];

        $tahun = $request->input('tahun', date('Y'));
        $bulan = $request->input('bulan', date('m'));
        $alamat = in_array($request->input('alamat'), $validKecamatan) ? $request->input('alamat') : $defaultKecamatan;



        // $tahun = $request->input('tahun', date('Y'));
        // $bulan = $request->input('bulan', date('m'));
        // $alamat = $request->input('alamat', '%amuntai selatan%');

        // $perkaras = DB::table('perkara')
        //     ->leftJoin('perkara_pihak1', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
        //     ->leftJoin('perkara_putusan', 'perkara.perkara_id', '=', 'perkara_putusan.perkara_id')
        //     ->select('perkara.nomor_perkara', 'perkara.tanggal_pendaftaran', 'perkara_pihak1.nama', 'perkara_pihak1.alamat', 'perkara_putusan.tanggal_putusan')
        //     ->whereYear('tanggal_pendaftaran', '=', $tahun)
        //     ->whereMonth('tanggal_pendaftaran', '=', $bulan)
        //     ->where('perkara_pihak1.urutan', '=', 1)
        //     ->when($alamat, function ($query, $alamat) {
        //         return $query->where('perkara_pihak1.alamat', 'like', '%' . $alamat . '%');
        //     })->paginate(10);

        $cari = $request->get('cari');

        $perkaras = DB::table('perkara')
            ->leftJoin('perkara_pihak1', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
            ->leftJoin('perkara_putusan', 'perkara.perkara_id', '=', 'perkara_putusan.perkara_id')
            ->select('perkara.nomor_perkara', 'perkara.tanggal_pendaftaran', 'perkara_pihak1.nama', 'perkara_pihak1.alamat', 'perkara_putusan.tanggal_putusan')
            ->whereYear('tanggal_pendaftaran', '=', $tahun)
            ->whereMonth('tanggal_pendaftaran', '=', $bulan)
            ->where('perkara_pihak1.urutan', '=', 1)
            ->when($alamat, function ($query, $alamat) {
                return $query->where('perkara_pihak1.alamat', 'like', '%' . $alamat . '%');
            })
            ->when($cari, function ($query, $cari) {
                return $query->where('perkara_pihak1.nama', 'like', '%' . $cari . '%');
            })
            ->paginate(10);
        // ->get();;

        // ->where('perkara_pihak1.alamat', 'like', $alamat)
        // ->toSql();
        // dd($perkaras);

        $kecamatans = DB::table('perkara_pihak1')->select('alamat')->pluck('alamat');
        $bulan = [
            "01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei",
            "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September",
            "10" => "Oktober", "11" => "Nopember", "12" => "Desember"
        ];

        $currentYear = date('Y');
        $tahun = range($currentYear - 5, $currentYear + 5);

        return view('pages.perkara-masuk-blg.index', compact('perkaras', 'kecamatans', 'bulan', 'tahun', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Menyimpan alamat, bulan, dan tahun ke dalam sesi
        session()->put('alamat', $request->input('alamat'));
        session()->put('bulan', $request->input('bulan'));
        session()->put('tahun', $request->input('tahun'));

        // Redirect ke route perkara-masuk.index
        // return redirect()->route('perkara-masuk.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(PerkaraMasuk $perkaraMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerkaraMasuk $perkaraMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerkaraMasuk $perkaraMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerkaraMasuk $perkaraMasuk)
    {
        //
    }
}
