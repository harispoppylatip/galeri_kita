<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\galerykita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    // ===== ADMIN =====

    public function index()
    {
        $albums = Album::withCount('photos')->latest()->paginate(12);
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('albums', 'public');
        }

        Album::create($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dibuat!');
    }

    public function show($id)
    {
        $album = Album::with('photos')->findOrFail($id);
        $availablePhotos = galerykita::whereDoesntHave('albums', function ($q) use ($id) {
            $q->where('albums.id', $id);
        })->latest()->get();

        return view('admin.albums.show', compact('album', 'availablePhotos'));
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        return view('admin.albums.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $album->nama = $request->nama;
        $album->deskripsi = $request->deskripsi;

        if ($request->hasFile('cover')) {
            if ($album->cover && Storage::disk('public')->exists($album->cover)) {
                Storage::disk('public')->delete($album->cover);
            }
            $album->cover = $request->file('cover')->store('albums', 'public');
        }

        $album->save();

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        if ($album->cover && Storage::disk('public')->exists($album->cover)) {
            Storage::disk('public')->delete($album->cover);
        }

        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dihapus!');
    }

    public function addPhotos(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        $request->validate([
            'photo_ids' => 'required|array|min:1',
            'photo_ids.*' => 'exists:gambar,id',
        ]);

        $album->photos()->syncWithoutDetaching($request->photo_ids);

        return redirect()->route('admin.albums.show', $id)->with('success', count($request->photo_ids) . ' foto ditambahkan ke album!');
    }

    public function removePhoto($albumId, $photoId)
    {
        $album = Album::findOrFail($albumId);
        $album->photos()->detach($photoId);

        return redirect()->route('admin.albums.show', $albumId)->with('success', 'Foto dihapus dari album!');
    }

    // ===== PUBLIC =====

    public function publicIndex()
    {
        $albums = Album::withCount('photos')->having('photos_count', '>', 0)->latest()->paginate(12);
        return view('pages.album', compact('albums'));
    }

    public function publicShow($id)
    {
        $album = Album::with('photos')->findOrFail($id);
        return view('pages.album-detail', compact('album'));
    }
}
