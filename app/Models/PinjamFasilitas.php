<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamFasilitas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function peminjaman(){
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id');
    }
}
