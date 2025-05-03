<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    protected $table = 'publikasi';
    protected $fillable = [
        'thumbnail', 
        'nama', 
        'deskripsi', 
        'content', 
        'dosen_id', 
        'publish', 
        'highlight', 
        'tahun'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'publikasi_tag');
    }
}
