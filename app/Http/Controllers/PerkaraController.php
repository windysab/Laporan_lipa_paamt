<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerkaraController extends Controller
{
    // public function getPerkaraData()
    // {
    //     $result = DB::table('perkara AS p')
    //         ->leftJoin('perkara_pihak1 AS pp1', 'p.perkara_id', '=', 'pp1.perkara_id')
    //         ->leftJoin('perkara_akta_cerai AS pac', 'p.perkara_id', '=', 'pac.perkara_id')
    //         ->leftJoin('perkara_putusan AS pp', 'p.perkara_id', '=', 'pp.perkara_id')
    //         ->where(function ($query) {
    //             $query->whereRaw('YEAR(pac.tgl_akta_cerai) = 2018')
    //                 ->whereRaw('MONTH(pac.tgl_akta_cerai) = 01')
    //                 ->orWhereRaw('YEAR(p.tanggal_pendaftaran) = 2018')
    //                 ->orWhereRaw('MONTH(p.tanggal_pendaftaran) = 01');
    //         })
    //         ->where('pp1.urutan', 1)
    //         ->where('pp1.alamat', 'like', '%PAMINGGIR%')
    //         ->orderBy('pac.nomor_akta_cerai')
    //         ->select('p.nomor_perkara', 'pp1.nama', 'pp1.alamat', 'p.tanggal_pendaftaran', 'pac.tgl_akta_cerai', 'pp.tanggal_putusan')
    //         ->get();

    //     return view('pages.perkara.index', ['result' => $result]);
    // }

    public function index(Request $request)
    {
        $validKecamatan = ['Amuntai Selatan', 'Amuntai Tengah', 'Amuntai Utara', 'Babirik', 'Banjang', 'Danau Panggang', 'Haur Gading', 'Paminggir', 'Sungai Pandan', 'Sungai Tabukan'];
        $defaultKecamatan = $validKecamatan[0];

        $tahun = $request->input('tahun', date('Y'));
        $bulan = $request->input('bulan', date('m'));
        $alamat = in_array($request->input('alamat'), $validKecamatan) ? $request->input('alamat') : $defaultKecamatan;

        $cari = $request->get('cari');

        $result = DB::table('perkara AS p')
            ->leftJoin('perkara_pihak1 AS pp1', 'p.perkara_id', '=', 'pp1.perkara_id')
            ->leftJoin('perkara_putusan AS pp', 'p.perkara_id', '=', 'pp.perkara_id')
            ->leftJoin('perkara_akta_cerai AS pac', 'p.perkara_id', '=', 'pac.perkara_id')
            ->where(function ($query) use ($tahun, $bulan) {
                $query->whereYear('p.tanggal_pendaftaran', $tahun)
                    ->whereMonth('p.tanggal_pendaftaran', $bulan);
            })
            ->where('pp1.urutan', 1)
            ->where('pp1.alamat', 'like', '%' . $alamat . '%')
            ->select('p.nomor_perkara', 'pp1.nama', 'pp1.alamat', 'p.tanggal_pendaftaran', 'pac.tgl_akta_cerai', 'pp.tanggal_putusan')
            ->orderBy('p.nomor_perkara', 'asc')
            ->orderBy('pac.nomor_akta_cerai')
            ->when($cari, function ($query, $cari) {
                return $query->where('pp1.nama', 'like', '%' . $cari . '%');
            })
            ->paginate(10);

        $bulan = [
            "01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei",
            "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September",
            "10" => "Oktober", "11" => "Nopember", "12" => "Desember"
        ];

        $currentYear = date('Y');
        $tahun = range($currentYear - 5, $currentYear + 5);

        return view('pages.perkara.index', ['result' => $result, 'kecamatans' => $validKecamatan, 'bulan' => $bulan, 'tahun' => $tahun, 'cari' => $cari]);
    }
}
