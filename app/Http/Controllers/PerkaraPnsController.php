<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerkaraPnsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.perkara-pns'); // Gantilah 'auth.perkara-pns' sesuai dengan nama middleware yang Anda buat.
    }


    public function index(Request $request)
    {
        $lap_tahun = $request->input('tahun', date('Y'));
        $lap_bulan = $request->input('bulan', date('m'));
        $jenis_perkara = $request->input('jenis_perkara', '%Pdt.G%'); // Adjust default value if needed

        $query = DB::table('perkara')
            ->select(
                'perkara.nomor_perkara',
                'perkara_penetapan.majelis_hakim_nama',
                'perkara_penetapan.panitera_pengganti_text',
                'perkara.tanggal_pendaftaran',
                'perkara_penetapan.penetapan_majelis_hakim',
                'perkara_penetapan.penetapan_hari_sidang',
                'perkara_penetapan.sidang_pertama',
                'perkara_putusan.tanggal_putusan',
                'perkara_putusan.status_putusan_nama',
                'pihak.pekerjaan'
            )
            ->leftJoin('perkara_penetapan', 'perkara.perkara_id', '=', 'perkara_penetapan.perkara_id')
            ->leftJoin('perkara_putusan', 'perkara.perkara_id', '=', 'perkara_putusan.perkara_id')
            ->leftJoin('perkara_pihak1', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
            ->leftJoin('pihak', 'perkara_pihak1.pihak_id', '=', 'pihak.id')
            ->where(function ($query) use ($lap_tahun, $lap_bulan) {
                $query->whereYear('perkara.tanggal_pendaftaran', $lap_tahun)
                    ->whereMonth('perkara.tanggal_pendaftaran', $lap_bulan)
                    ->orWhereYear('perkara_penetapan.penetapan_majelis_hakim', $lap_tahun)
                    ->whereMonth('perkara_penetapan.penetapan_majelis_hakim', $lap_bulan)
                    ->orWhereYear('perkara_penetapan.penetapan_hari_sidang', $lap_tahun)
                    ->whereMonth('perkara_penetapan.penetapan_hari_sidang', $lap_bulan)
                    ->orWhereYear('perkara_penetapan.sidang_pertama', $lap_tahun)
                    ->whereMonth('perkara_penetapan.sidang_pertama', $lap_bulan)
                    ->orWhereYear('perkara_putusan.tanggal_putusan', $lap_tahun)
                    ->whereMonth('perkara_putusan.tanggal_putusan', $lap_bulan)
                    ->orWhereNull('perkara_putusan.tanggal_putusan');
            })
            ->where('perkara.nomor_perkara', 'like', "%$jenis_perkara%")
            ->where('perkara_pihak1.urutan', '=', '1')
            ->where(function ($query) {
                $query->where('pihak.pekerjaan', 'like', '%PNS%')
                    ->orWhere('pihak.pekerjaan', 'like', '%Pegawai Negeri Sipil%');
            })
            ->where('pihak.pekerjaan', 'not like', '%Pensiunan%')
            ->orderBy('perkara.perkara_id');

        // Paginate the results
        $result = $query->paginate(10);

        // Define additional data for the view if needed
        $months = [
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni',
            '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        $tahunArray = range(date('Y') - 5, date('Y'));

        return view('pages.perkara-pns.index', [
            'result' => $result,
            'bulan' => $months,
            'tahun' => $tahunArray,
            'selectedBulan' => $lap_bulan,
            'selectedTahun' => $lap_tahun
        ]);
    }
}
