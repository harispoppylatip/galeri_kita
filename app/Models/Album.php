<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'cover'];

    public function photos()
    {
        return $this->belongsToMany(galerykita::class, 'album_gambar', 'album_id', 'gambar_id')->withTimestamps();
    }

    public function getCoverUrl()
    {
        if ($this->cover) {
            return asset('storage/' . $this->cover);
        }

        $firstPhoto = $this->photos()->first();
        return $firstPhoto ? asset('storage/' . $firstPhoto->nama) : null;
    }
}
