<?php

// app/Models/Perkara.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perkara extends Model
{
    protected $table = 'perkara';
    protected $primaryKey = 'perkara_id';

    // Tentukan kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
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
          
    ];

    // Tentukan relasi jika diperlukan
    // public function namaRelasi()
    // {
    //     return $this->belongsTo(ModelLain::class, 'foreign_key', 'local_key');
    // }
}
