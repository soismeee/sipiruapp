<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function jadwal_aula(){
        return $this->belongsTo(JadwalAula::class, 'ja_id');
    }

    public function klien(){
        return $this->belongsTo(Klien::class, 'klien_id');
    }
}
