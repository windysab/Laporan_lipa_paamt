<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerkaraEcourtController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan inputan tahun dan bulan dengan nilai default saat ini
        $lap_tahun = $request->input('tahun', date('Y'));
        $lap_bulan = $request->input('bulan', date('m'));
        $jenis_perkara = $request->input('jenis_perkara', '%'); // Nilai default '%', menandakan semua perkara

        $query = DB::table('perkara')
            ->select(
                'perkara.nomor_perkara',
                'perkara.jenis_perkara_nama',
                'perkara.tanggal_pendaftaran',
                'perkara_pihak1.nama as nama_pihak',
                'pihak.email'
            )
            ->join('perkara_efiling_id', 'perkara.perkara_id', '=', 'perkara_efiling_id.perkara_id')
            ->join('perkara_pihak1', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
            ->join('pihak', 'perkara_pihak1.pihak_id', '=', 'pihak.id')
            ->whereYear('perkara.tanggal_pendaftaran', '=', $lap_tahun)
            ->whereMonth('perkara.tanggal_pendaftaran', '=', $lap_bulan)
            ->where('perkara.nomor_perkara', 'LIKE', "%$jenis_perkara%")
            ->where('perkara_pihak1.urutan', '=', '1')
            ->orderBy('perkara.perkara_id')
            // ->get();
            ->paginate(10);

        // Data tambahan untuk dropdown filter
        $months = [
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni',
            '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        $tahunArray = range(date('Y') - 5, date('Y'));

        // Mengirim data ke view
        return view('pages.perkara-ecourt.index', [
            'perkaras' => $query,
            'bulan' => $months,
            'tahun' => $tahunArray,
            'selectedBulan' => $lap_bulan,
            'selectedTahun' => $lap_tahun
        ]);
    }
}
