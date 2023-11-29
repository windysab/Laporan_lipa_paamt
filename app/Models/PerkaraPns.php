<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkaraPns extends Model
{
    use HasFactory;
    protected $table = 'perkara';
    // public function penetapan()
    // {
    //     return $this -> hasOne('App\Models\PerkaraPenetapan', 'perkara_id', 'perkara_id');
    // }
}
