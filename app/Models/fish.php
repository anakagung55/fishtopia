<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fish extends Model
{
    use HasFactory;

    protected $table = 'fishes';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama',
        'jenis',
        'foto',
        'deskripsi',
    ];
}
