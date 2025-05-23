<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $fillable = [
        'thumbnail',
        'nama', 
        'deskripsi', 
        'content', 
        'sudah_lewat', 
        'tanggal'
    ];
}
