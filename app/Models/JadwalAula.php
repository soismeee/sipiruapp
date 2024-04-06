<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAula extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $primaryKey = 'id';
    public $incrementing = false;
}
