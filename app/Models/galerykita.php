<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class galerykita extends Model
{
    protected $table = 'gambar';
    protected $fillable = ['nama', 'judul', 'description'];

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_gambar', 'gambar_id', 'album_id')->withTimestamps();
    }
}
