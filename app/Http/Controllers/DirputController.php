<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirputController extends Controller
{



    public function index(Request $request)
    {
        $nomor_perkara = $request->input('nomor_perkara');

        $perkara = DB::table('perkara AS p')
            ->select('p.nomor_perkara', 'p.tanggal_pendaftaran AS tanggal_register', 'pp.tanggal_putusan AS tanggal_diputus', 'p.para_pihak AS para_pihak', 'pp.amar_putusan AS catatan_amar', 'sp.nama AS amar', 'pb.amar_putusan_banding AS catatan_amar_banding', DB::raw("IF(LENGTH(ppt.majelis_hakim_id) - LENGTH(REPLACE(ppt.majelis_hakim_id, ',', '')) > 1, '2', '1') AS hakim"), 'gg.hakim_ketua', 'gg.hakim_anggota', 'ppt.panitera_pengganti_text AS panitera', 'pp.tanggal_bht AS bht', 'p.jenis_perkara_nama AS kata_kunci', DB::raw("SUBSTRING_INDEX(pp.amar_putusan_dok, '/', -1) AS file_putusan_nama"), 'pp.amar_putusan_dok AS file_putusan', 'ee.guid', 'ee.parentguid', 'ff.status_penahanan')
            ->leftJoin('perkara_putusan AS pp', 'p.perkara_id', '=', 'pp.perkara_id')
            ->leftJoin('status_putusan AS sp', 'sp.id', '=', 'pp.status_putusan_id')
            ->leftJoin('perkara_banding AS pb', 'p.perkara_id', '=', 'pb.perkara_id')
            ->leftJoin('perkara_penetapan AS ppt', 'p.perkara_id', '=', 'ppt.perkara_id')
            ->leftJoin(DB::raw("(SELECT p.perkara_id, p.alur_perkara_id, p.jenis_perkara_id, dsr.guid, COALESCE(drf.parentguid, dd.parentguid) AS parentguid FROM perkara AS p LEFT JOIN dirput_sipp_ref AS dsr ON p.jenis_perkara_id = dsr.jenis_perkara_id AND p.alur_perkara_id = dsr.alur_perkara_id LEFT JOIN dirput_ref AS drf ON dsr.guid = drf.guid LEFT JOIN (SELECT alur_perkara_id, parentguid FROM dirput_ref GROUP BY alur_perkara_id, parentguid) AS dd ON p.alur_perkara_id = dd.alur_perkara_id GROUP BY p.perkara_id, p.alur_perkara_id, p.jenis_perkara_id, dsr.guid, parentguid) AS ee"), 'p.perkara_id', '=', 'ee.perkara_id')
            ->leftJoin(DB::raw("(SELECT IF(ppt.status_putusan_id IN (12, 13, 14), '1', '0') AS status_penahanan, ppt.perkara_id FROM perkara_putusan_terdakwa AS ppt LEFT JOIN status_putusan AS sp ON ppt.status_putusan_id = sp.id GROUP BY ppt.perkara_id, status_penahanan) AS ff"), 'p.perkara_id', '=', 'ff.perkara_id')
            ->leftJoin(DB::raw("(SELECT perkara_id, SUBSTRING_INDEX(GROUP_CONCAT(CONCAT('Hakim Anggota : ', hakim_nama) SEPARATOR '<br>'), '<br>', -2) AS hakim_anggota, SUBSTRING_INDEX(GROUP_CONCAT(CONCAT('Hakim Ketua : ', hakim_nama) SEPARATOR '<br>'), '<br>', 1) AS hakim_ketua FROM perkara_hakim_pn GROUP BY perkara_id) AS gg"), 'p.perkara_id', '=', 'gg.perkara_id')
            ->where('p.nomor_perkara', '=', $nomor_perkara)
            ->get();

        // Selanjutnya, Anda bisa menggunakan data hasil query, misalnya:
        return view('pages.dirput.index', [
            'perkaras' => $perkara,
        ]);
    }
}
