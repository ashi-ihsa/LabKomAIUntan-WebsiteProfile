<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $fillable = [
        'nama'
    ];

    public function artikels()
    {
        return $this->belongsToMany(Artikel::class, 'artikel_tag');
    }

    public function publikasis()
    {
        return $this->belongsToMany(Publikasi::class, 'publikasi_tag');
    }
}
