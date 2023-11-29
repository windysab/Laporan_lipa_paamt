<?php

namespace App\Http\Controllers;

use App\Models\Gaib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GaibController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $bulan = $request->input('bulan', date('m'));
        $jenis_perkara = '%Pdt.G%';
        $alamat_tidak_diketahui = '%tidak diketahui%';

        $result = DB::table('perkara AS p')
            ->select(
                'p.nomor_perkara',
                'pp.majelis_hakim_nama',
                'pp.panitera_pengganti_text',
                'p.tanggal_pendaftaran',
                'pp.penetapan_majelis_hakim',
                'pp.penetapan_hari_sidang',
                'pp.sidang_pertama',
                'pput.tanggal_putusan',
                'pput.status_putusan_nama',
                'pp2.alamat'
            )
            ->leftJoin('perkara_penetapan AS pp', 'p.perkara_id', '=', 'pp.perkara_id')
            ->leftJoin('perkara_putusan AS pput', 'p.perkara_id', '=', 'pput.perkara_id')
            ->leftJoin('perkara_pihak2 AS pp2', 'p.perkara_id', '=', 'pp2.perkara_id')
            ->where(function ($query) use ($tahun, $bulan, $jenis_perkara, $alamat_tidak_diketahui) {
                $query->whereYear('p.tanggal_pendaftaran', $tahun)
                    ->whereMonth('p.tanggal_pendaftaran', $bulan)
                    ->orWhere(function ($q) use ($tahun, $bulan) {
                        $q->whereYear('pp.penetapan_majelis_hakim', $tahun)
                            ->whereMonth('pp.penetapan_majelis_hakim', $bulan);
                    })
                    ->orWhere(function ($q) use ($tahun, $bulan) {
                        $q->whereYear('pp.penetapan_hari_sidang', $tahun)
                            ->whereMonth('pp.penetapan_hari_sidang', $bulan);
                    })
                    ->orWhere(function ($q) use ($tahun, $bulan) {
                        $q->whereYear('pp.sidang_pertama', $tahun)
                            ->whereMonth('pp.sidang_pertama', $bulan);
                    })
                    ->orWhere(function ($q) use ($tahun, $bulan) {
                        $q->whereYear('pput.tanggal_putusan', $tahun)
                            ->whereMonth('pput.tanggal_putusan', $bulan);
                    })
                    ->orWhereNull('pput.tanggal_putusan');
            })
            ->where('p.nomor_perkara', 'LIKE', $jenis_perkara)
            ->where('pp2.alamat', 'LIKE', $alamat_tidak_diketahui)
            ->orderBy('p.perkara_id', 'asc')
            ->paginate(10);

        // return view('pages.perkara-gaib.index', ['result' => $result->items()]);
        $tahun = $request->input('tahun', date('Y'));
        $tahunArray =  range(date('Y') - 5, date('Y'));
        $months = [
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni', '7' => 'Juli',
            '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' =>  'November', '12' => 'Desember'
        ];
        $bulan = $request->input('bulan', date('m'));

        return view('pages.perkara-gaib.index', [
            'result' => $result,
            'bulan' => $months,
            'tahun' => $tahunArray,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // @foreach ($perkara as $prk)
        //<p>{{ $prk->nomor_perkara }}</p>
        //<p>{{ $prk->panitera_pengganti_text }}</p>
        //<!-- ...dan lain-lain -->
        //@endforeach
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gaib $gaib)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gaib $gaib)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gaib $gaib)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gaib $gaib)
    {
        //
    }
}
