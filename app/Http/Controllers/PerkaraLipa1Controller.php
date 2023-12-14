<?php

namespace App\Http\Controllers;



use App\Exports\Lipa1Export;
use Illuminate\Http\Request;
use App\Traits\PerkaraDataTrait;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PerkaraLipa1Controller extends Controller
{
    use PerkaraDataTrait;


    // public function getData($lap_tahun, $lap_bulan, $jenis_perkara)
    // {
    //     $query = DB::table('perkara')
    //         ->select(
    //             'nomor_perkara',
    //             'jenis_perkara_nama',
    //             'majelis_hakim_nama',
    //             'panitera_pengganti_text',
    //             'tanggal_pendaftaran',
    //             'penetapan_majelis_hakim',
    //             'penetapan_hari_sidang',
    //             'sidang_pertama',
    //             'tanggal_putusan',
    //             'status_putusan_id',
    //             'pekerjaan',
    //             'perkara_pihak2.alamat as alamat_pihak2',
    //             'prodeo',
    //             'pihak.email as email_pihak1',
    //         )
    //         ->leftJoin('perkara_penetapan', 'perkara.perkara_id', '=', 'perkara_penetapan.perkara_id')
    //         ->leftJoin('perkara_putusan', 'perkara.perkara_id', '=', 'perkara_putusan.perkara_id')
    //         ->leftJoin('perkara_pihak1', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
    //         ->leftJoin('perkara_pihak2', 'perkara.perkara_id', '=', 'perkara_pihak2.perkara_id')
    //         ->leftJoin('pihak', 'perkara_pihak1.pihak_id', '=', 'pihak.id')
    //         ->leftJoin('perkara_efiling_id', 'perkara.perkara_id', '=', 'perkara_efiling_id.perkara_id')
    //         ->where(function ($innerQuery) use ($lap_tahun, $lap_bulan) {
    //             $innerQuery
    //                 ->whereRaw("YEAR(tanggal_pendaftaran) = ? AND MONTH(tanggal_pendaftaran) = ?", [$lap_tahun, $lap_bulan])
    //                 ->orWhereRaw("YEAR(penetapan_majelis_hakim) = ? AND MONTH(penetapan_majelis_hakim) = ?", [$lap_tahun, $lap_bulan])
    //                 ->orWhereRaw("YEAR(penetapan_hari_sidang) = ? AND MONTH(penetapan_hari_sidang) = ?", [$lap_tahun, $lap_bulan])
    //                 ->orWhereRaw("YEAR(sidang_pertama) = ? AND MONTH(sidang_pertama) = ?", [$lap_tahun, $lap_bulan])
    //                 ->orWhereRaw("YEAR(tanggal_putusan) = ? AND MONTH(tanggal_putusan) = ?", [$lap_tahun, $lap_bulan])
    //                 ->orWhereNull('tanggal_pendaftaran');
    //         })

    //         ->where('perkara_pihak1.pihak_id', '!=', '1')
    //         ->where('perkara.nomor_perkara', 'like', '%' . $jenis_perkara . '%')
    //         ->where('perkara_pihak1.urutan', '1')
    //         ->where('pekerjaan', 'not like', '%Pensiunan%')



    //         ->orderBy('tanggal_pendaftaran');

    //     // Uncomment baris berikut untuk debugging
    //     // dd($query->toSql(), $query->getBindings());
    //     // dd($query->toSql(), $query->getBindings());
    //     $result = $query->get();

    //     // Uncomment baris berikut untuk debugging
    // // dd($result);

    //     return $result;
    // }



    public function index(Request $request)
    {
        $lap_tahun = $request->input('tahun', date('Y'));
        $lap_bulan = $request->input('bulan', date('m'));
        $jenis_perkara = $request->input('jenis_perkara');
        // dd($lap_tahun, $lap_bulan, $jenis_perkara);


        $query = $this->getData($lap_tahun, $lap_bulan, $jenis_perkara);


        $jenis_perkara = [
            'Pdt.G' => 'Pdt.G',
            'Pdt.P' => 'Pdt.P',
        ];

        $months = [
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', '5' => 'Mei', '6' => 'Juni',
            '7' => 'Juli', '8' => 'Agustus', '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        $tahunArray = range(date('Y') - 5, date('Y'));

        return view('pages.perkara-lipa1.index', [
            'result' => $query,
            'bulan' => $months,
            'tahun' => $tahunArray,
            'jenis_perkara' => $jenis_perkara,
            'selectedBulan' => $lap_bulan,
            'selectedTahun' => $lap_tahun,
            'request' => $request,
        ]);
    }

    public function exportLipa1(Request $request)
    {
        $lap_tahun = $request->input('tahun', date('Y'));
        $lap_bulan = $request->input('bulan', date('m'));
        $jenis_perkara = $request->input('jenis_perkara');

        $query = $this->getData($lap_tahun, $lap_bulan, $jenis_perkara);

        // Pastikan $query berisi data yang valid
        dd($query);

        return Excel::download(new Lipa1Export($query), 'lipa1_export.xlsx');
    }
}
