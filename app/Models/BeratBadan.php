<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeratBadan extends Model
{
    use HasFactory;

    protected $table = 'berat_badan';

    protected $fillable = [
        'user_id',
        'berat',
        'tanggal'
    ];
}