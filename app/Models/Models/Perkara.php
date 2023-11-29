<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkara extends Model
{
    use HasFactory;
    protected $table = 'perkara';

    public function perkara_penetapan()
    {
        return $this->hasOne(PerkaraPenetapan::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_putusan()
    {
        return $this->hasOne(PerkaraPutusan::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_pihak1()
    {
        return $this->hasOne(PerkaraPihak1::class, 'perkara_id', 'perkara_id');
    }

    public function pihak()
    {
        return $this->hasOne(Pihak::class, 'id', 'pihak_id');
    }

    public function perkara_pihak2()
    {
        return $this->hasOne(PerkaraPihak2::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_pemohon()
    {
        return $this->hasOne(PerkaraPemohon::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_tergugat()
    {
        return $this->hasOne(PerkaraTergugat::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_hakim()
    {
        return $this->hasOne(PerkaraHakim::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_jurusita()
    {
        return $this->hasOne(PerkaraJurusita::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_panjara()
    {
        return $this->hasOne(PerkaraPanjara::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_jaksa()
    {
        return $this->hasOne(PerkaraJaksa::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_hari_sidang()
    {
        return $this->hasOne(PerkaraHariSidang::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_catatan_harian()
    {
        return $this->hasOne(PerkaraCatatanHarian::class, 'perkara_id', 'perkara_id');
    }

    public function perkara_amar_putusan()
    {
        return $this->hasOne(PerkaraAmarPutusan::class, 'perkara_id', 'perkara_id');
    }

    


}
