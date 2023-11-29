<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaib extends Model
{
    use HasFactory;
    protected $table = 'perkara'; // Nama tabel yang dihubungkan dengan model

    // Relasi dengan model lainnya jika ada
    public function penetapan(){
         return $this->hasOne('App\Penetapan');
    }

    public function putusan(){
         return $this->hasOne('App\Putusan');
    }

    public function perkaraPihak2(){
         return $this->hasOne('App\PerkaraPihak2');
    }

    public function pihak(){
         return $this->hasOne('App\Pihak');
    }
}
