<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelasUserRoles;
use App\Models\Assignment;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Lecture;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class profileController extends Controller
{
    public function showProfile()
{
    $user = Auth::user();

    // Ambil semua role user terhadap kelas
    $roles = KelasUserRoles::with('lecture')
        ->where('user_id', $user->id)
        ->get();

    // Kelas diikuti (sebagai siswa)
    $kelasDiikuti = $roles->where('role', 'siswa')->pluck('lecture');
    $kelasDiikutiIDs = $roles->where('role', 'siswa')->pluck('lecture_id');

    // Kelas dibimbing (sebagai tentor)
    $kelasDibimbing = $roles->where('role', 'tentor')->pluck('lecture');
    $kelasDibimbingIDs = $roles->where('role', 'tentor')->pluck('lecture_id');

    // Tugas sebagai siswa
    $tugasSiswa = Assignment::with('lecture')
        ->whereIn('lecture_id', $kelasDiikutiIDs)
        ->where('deadline', '>', Carbon::now())
        ->orderBy('deadline', 'asc')
        ->get();

    // Tugas sebagai tentor
    $tugasTentor = Assignment::with('lecture')
        ->whereIn('lecture_id', $kelasDibimbingIDs)
        ->where('deadline', '>', Carbon::now())
        ->orderBy('deadline', 'asc')
        ->get();

    return view('profile', compact(
        'user',
        'kelasDiikuti',
        'kelasDibimbing',
        'tugasSiswa',
        'tugasTentor'
    ));
}
public function update(Request $request)
{
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    if ($request->hasFile('avatar')) {
        // Hapus avatar lama jika ada
        if ($user->avatar) {
            $oldAvatarPath = str_replace('/storage', 'public', $user->avatar);
            Storage::delete($oldAvatarPath);
        }

        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $data['avatar'] = Storage::url($avatarPath);
    }

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }
     /** @var \App\Models\User $user */
    $user->update($data);

    return response()->json([
        'success' => true,
        'message' => 'Profile updated successfully!'


    ]);
}
}
