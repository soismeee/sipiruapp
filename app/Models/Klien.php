<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $primaryKey = 'id';
    public $incrementing = false;
}
