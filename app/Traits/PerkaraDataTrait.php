<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait PerkaraDataTrait
{
    public function getData($lap_tahun, $lap_bulan, $jenis_perkara)
    {
        $query = DB::table('perkara')
            ->select(
                'nomor_perkara',
                'jenis_perkara_nama',
                'majelis_hakim_nama',
                'panitera_pengganti_text',
                'tanggal_pendaftaran',
                'penetapan_majelis_hakim',
                'penetapan_hari_sidang',
                'sidang_pertama',
                'tanggal_putusan',
                'status_putusan_id',
                'pekerjaan',
                'perkara_pihak2.alamat as alamat_pihak2',
                'prodeo',
                'pihak.email as email_pihak1',
            )
            ->leftJoin('perkara_penetapan', 'perkara.perkara_id', '=', 'perkara_penetapan.perkara_id')
            ->leftJoin('perkara_putusan', 'perkara.perkara_id', '=', 'perkara_putusan.perkara_id')
            ->leftJoin('perkara_pihak1', 'perkara.perkara_id', '=', 'perkara_pihak1.perkara_id')
            ->leftJoin('perkara_pihak2', 'perkara.perkara_id', '=', 'perkara_pihak2.perkara_id')
            ->leftJoin('pihak', 'perkara_pihak1.pihak_id', '=', 'pihak.id')
            ->leftJoin('perkara_efiling_id', 'perkara.perkara_id', '=', 'perkara_efiling_id.perkara_id')

            ->where(function ($innerQuery) use ($lap_tahun, $lap_bulan) {
                $innerQuery
                    ->whereRaw("YEAR(tanggal_pendaftaran) = ? AND MONTH(tanggal_pendaftaran) = ?", [$lap_tahun, $lap_bulan])
                    ->orWhereRaw("YEAR(penetapan_majelis_hakim) = ? AND MONTH(penetapan_majelis_hakim) = ?", [$lap_tahun, $lap_bulan])
                    ->orWhereRaw("YEAR(penetapan_hari_sidang) = ? AND MONTH(penetapan_hari_sidang) = ?", [$lap_tahun, $lap_bulan])
                    ->orWhereRaw("YEAR(sidang_pertama) = ? AND MONTH(sidang_pertama) = ?", [$lap_tahun, $lap_bulan])
                    ->orWhereRaw("YEAR(tanggal_putusan) = ? AND MONTH(tanggal_putusan) = ?", [$lap_tahun, $lap_bulan])
                    ->orWhereNull('tanggal_pendaftaran');
            })

            ->where('perkara_pihak1.pihak_id', '!=', '1')
            ->where('perkara.nomor_perkara', 'like', '%' . $jenis_perkara . '%')
            ->where('perkara_pihak1.urutan', '1')
            ->where('pekerjaan', 'not like', '%Pensiunan%')



            ->orderBy('tanggal_pendaftaran');



        // Uncomment baris berikut untuk debugging
        // dd($query->toSql(), $query->getBindings());
        // dd($query->toSql(), $query->getBindings());
        //dd($query->toSql());
        // dd(DB::getQueryLog());
        // dd([
        //     'lap_tahun' => $lap_tahun,
        //     'lap_bulan' => $lap_bulan,
        //     'jenis_perkara' => $jenis_perkara,

        // ]);

        $result = $query->get();
        // dd($result);

        // Uncomment baris berikut untuk debugging
        //  dd($result);

        return $result;
    }
}
