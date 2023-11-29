<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DispensasiKawin;
use Illuminate\Support\Facades\DB;

class DispensasiKawinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mendapatkan inputan tahun dan bulan dengan nilai default saat ini
        $lap_tahun = $request->input('tahun', date('Y'));
        $lap_bulan = $request->input('bulan', date('m'));
        $jenis_perkara = $request->input('jenis_perkara', '%'); // Nilai default '%', menandakan semua perkara

        $query = DB::table('perkara')
            ->leftJoin('perkara_putusan', 'perkara.perkara_id', '=', 'perkara_putusan.perkara_id')
            ->leftJoin('status_putusan', 'perkara_putusan.status_putusan_id', '=', 'status_putusan.id')
            ->leftJoin('perkara_jadwal_sidang', 'perkara.perkara_id', '=', 'perkara_jadwal_sidang.perkara_id')
            ->leftJoin('perkara_alasan_nikah', 'perkara.perkara_id', '=', 'perkara_alasan_nikah.perkara_id')
            ->select('nomor_perkara', 'tanggal_pendaftaran', 'tanggal_putusan', 'status_putusan.nama as jenis_putusan', 'perkara_alasan_nikah.nama as alasan_nikah', 'tanggal_sidang')
            ->whereYear('tanggal_pendaftaran', $lap_tahun)
            ->whereMonth('tanggal_pendaftaran', $lap_bulan)
            ->where('jenis_perkara_nama', 'like', '%Dispensasi%')
            ->orderBy('perkara.perkara_id')
            ->paginate(10);


        // Data tambahan untuk dropdown filter
        $months = [
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni',
            '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        $tahunArray = range(date('Y') - 5, date('Y'));

        // Mengirim data ke view
        return view('pages.perkara-diska.index', [
            'perkaras' => $query,
            'bulan' => $months,
            'tahun' => $tahunArray,
            'selectedBulan' => $lap_bulan,
            'selectedTahun' => $lap_tahun
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DispensasiKawin $dispensasiKawin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DispensasiKawin $dispensasiKawin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DispensasiKawin $dispensasiKawin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DispensasiKawin $dispensasiKawin)
    {
        //
    }
}
