<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = User::latest()->paginate(10);
        return view('admin.users.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username|alpha_dash',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.users.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,' . $admin->id,
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.users.index')->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        if (User::count() <= 1) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa menghapus admin terakhir!');
        }

        if ($admin->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $admin->delete();

        return redirect()->route('admin.users.index')->with('success', 'Admin berhasil dihapus!');
    }
}
