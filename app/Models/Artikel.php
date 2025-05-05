<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $fillable = [
        'thumbnail',
        'nama',
        'content', 
        'publish', 
        'highlight'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'artikel_tag');
    }
}
