<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class JadwalSidangController extends Controller
{

        public function index(Request $request)
        {
            // $tanggal_sidang = $request->input('tanggal_sidang'); // Mengambil input tanggal sidang dari
            $tanggal_sidang = $request->input('tanggal_sidang', date('Y-m-d'));

            // Memastikan tanggal_sidang ada dan valid
            if (!$tanggal_sidang) {
                return back()->with('error', 'Tanggal sidang tidak boleh kosong');
            }

            // Penyesuaian Query tanpa referensi ke pj.pangkat
            $query = DB::table('perkara_jadwal_sidang as jadwalSidang')
                ->select([
                    'perkara.perkara_id as IDPerkara',
                    'perkara.nomor_perkara as noPerkara',
                    'jadwalSidang.ruangan as ruangSidang',
                    DB::raw("CONCAT(jadwalSidang.jam_sidang, ' ', (SELECT value FROM sys_config WHERE id = 75)) as jamSidang"),
                    'jadwalSidang.agenda as agendaSidang',
                    'perkara.pihak1_text as pihak1', // Menghilangkan referensi kepada pj.pangkat
                    'perkara.pihak2_text as pihak2', // Menghilangkan referensi kepada pp2.pangkat
                    DB::raw("(SELECT
                        CASE
                            WHEN p1.count_names > 1 THEN CONCAT(p1.names_concat, ', dkk')
                            ELSE p1.names_concat
                        END
                    FROM
                        (SELECT
                            COUNT(pp1.id) AS count_names,
                            GROUP_CONCAT(pp1.nama) AS names_concat
                        FROM perkara_pihak1 pp1
                        WHERE pp1.perkara_id = perkara.perkara_id
                        ) p1
                    ) AS penggugat"),
                    DB::raw("(SELECT
                        CASE
                            WHEN p2.count_names > 1 THEN CONCAT(p2.names_concat, ', dkk')
                            ELSE p2.names_concat
                        END
                    FROM
                        (SELECT
                            COUNT(pp2.id) AS count_names,
                            GROUP_CONCAT(pp2.nama) AS names_concat
                        FROM perkara_pihak2 pp2
                        WHERE pp2.perkara_id = perkara.perkara_id
                        ) p2
                    ) AS tergugat"),
                    DB::raw("(SELECT GROUP_CONCAT(IF (hakim_pn.pangkat = '0', hakim_pn.nama_gelar, CONCAT(perkara_hakim_pn.jabatan_hakim_nama,': ', CONCAT(hakim_pn.pangkat,' ',hakim_pn.nama_gelar))) SEPARATOR '<br/>')
                        FROM perkara_hakim_pn
                        LEFT JOIN hakim_pn ON hakim_pn.id=perkara_hakim_pn.hakim_id
                        WHERE perkara_hakim_pn.perkara_id=perkara.perkara_id AND perkara_hakim_pn.aktif = 'Y'
                        GROUP BY perkara_hakim_pn.perkara_id
                        ORDER BY perkara_hakim_pn.urutan ASC) AS namaHakim"),
                    DB::raw("(SELECT GROUP_CONCAT(IF (panitera_pn.pangkat = '0', panitera_pn.nama_gelar, CONCAT(panitera_pn.pangkat,' ',panitera_pn.nama_gelar)) SEPARATOR '<br/>')
                        FROM perkara_panitera_pn
                        LEFT JOIN panitera_pn ON panitera_pn.id=perkara_panitera_pn.panitera_id
                        WHERE perkara_panitera_pn.perkara_id=perkara.perkara_id AND perkara_panitera_pn.aktif = 'Y'
                        GROUP BY perkara_panitera_pn.perkara_id
                        ORDER BY perkara_panitera_pn.urutan ASC) AS namaPanitera"),

                ])
                ->leftJoin('perkara', 'perkara.perkara_id', '=', 'jadwalSidang.perkara_id')
                // join lain yang anda perlukan
                ->where('jadwalSidang.tanggal_sidang', '=', $tanggal_sidang)
                ->get();

            // Mengembalikan hasil query ke view dengan parameter yang dibutuhkan
            return view('pages.jadwal-sidang.index', [
                'jadwalSidangs' => $query,
                'tanggal_sidang' => $tanggal_sidang,
            ]);
        }
}
