<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $fillable = [
        'nama', 
        'image', 
        'deskripsi', 
        'content'
    ];

    public function publikasi()
    {
        return $this->hasMany(Publikasi::class);
    }
}
