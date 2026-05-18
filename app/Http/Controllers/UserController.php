<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->where('email', '!=', 'superadmin@system.com');
        return view('admin.pengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,staff',
            'status' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'username' => $request->username,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'avatar' => $avatarPath
        ]);

        return back()->with('success', 'Akun berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // simpan data lama
        $oldRole = $user->role;
        $oldStatus = $user->status;

        $data = [
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        // 🔥 CEK: apakah user yang sedang login ini yang diupdate?
        if (Auth::check() && Auth::id() == $user->id) {

            // jika role berubah ATAU status jadi nonaktif
            if ($oldRole != $user->role || $user->status == 'nonaktif') {

                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return redirect()->route('login')
                    ->with('error', 'Session berakhir karena perubahan akun. Silakan login kembali.');
            }
        }

        return back()->with('success', 'Akun berhasil diupdate');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    }

    public function editProfile()
{
    return view('admin.edit-profil');
}

public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'username' => 'required|unique:users,username,' . $user->id,
        'password' => 'nullable|min:6|confirmed',
        'avatar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->username = $request->username;

    if ($request->hasFile('avatar')) {

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
    }

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui');
}

}