<?php

namespace App\Http\Controllers;
use App\Models\galerykita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class galerykitacontroller extends Controller
{
    public function index()
    {
        $data = galerykita::latest()->take(6)->get();
        return view('pages.home', compact('data'));
    }

    public function galeri(Request $request)
    {
        $query = galerykita::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $sort = $request->get('sort', 'terbaru');
        $query->orderBy('created_at', $sort === 'terlama' ? 'asc' : 'desc');

        $photos = $query->paginate(20)->withQueryString();
        $monthCount = galerykita::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        return view('pages.galeri', compact('photos', 'monthCount'));
    }

    public function config(Request $request)
    {
        $query = galerykita::latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $photos = $query->paginate(10)->withQueryString();
        $todayCount = galerykita::whereDate('created_at', Carbon::today())->count();
        $weekCount = galerykita::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        return view('admin.adminconfig', compact('photos', 'todayCount', 'weekCount'));
    }

    public function store(request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,png,jpeg|max:5048',
            'judul' => 'required|min:5',
        ]);

        $imagename = $request->file('gambar')->store('galeri', 'public');

        galerykita::create([
            'nama' => $imagename,
            'judul' => $request->judul,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.upload')->with('success', 'Foto berhasil diupload!');
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'photos' => 'required|array|min:1',
            'photos.*' => 'required|image|mimes:jpg,png,jpeg|max:5048',
            'juduls' => 'required|array',
            'juduls.*' => 'required|min:5',
        ]);

        $photos = $request->file('photos');
        $juduls = $request->input('juduls');
        $descriptions = $request->input('descriptions', []);

        foreach ($photos as $index => $photo) {
            $path = $photo->store('galeri', 'public');

            galerykita::create([
                'nama' => $path,
                'judul' => $juduls[$index] ?? 'Tanpa Judul',
                'description' => $descriptions[$index] ?? null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => count($photos) . ' foto berhasil diupload!',
        ]);
    }

    public function update(Request $request, $id)
    {
        $photo = galerykita::findOrFail($id);

        $request->validate([
            'judul' => 'required|min:5',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:5048',
        ]);

        $photo->judul = $request->judul;
        $photo->description = $request->description;

        if ($request->hasFile('gambar')) {
            // Hapus foto lama
            if ($photo->nama && Storage::disk('public')->exists($photo->nama)) {
                Storage::disk('public')->delete($photo->nama);
            }
            $photo->nama = $request->file('gambar')->store('galeri', 'public');
        }

        $photo->save();

        return redirect()->route('admin.config')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $photo = galerykita::findOrFail($id);

        // Hapus file dari storage
        if ($photo->nama && Storage::disk('public')->exists($photo->nama)) {
            Storage::disk('public')->delete($photo->nama);
        }

        $photo->delete();

        return redirect()->route('admin.config')->with('success', 'Foto berhasil dihapus!');
    }
}
