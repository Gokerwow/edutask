<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\KelasUserRoles;
use App\Models\Lecture as ModelsLecture;
use App\Models\materi;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexLecture()
    {
        return view('lecture.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createLecture()
    {
        return view('lecture.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeLecture(Request $request)
    {
        $validate = $request->validate([
            'class-name' => 'required|string|max:255',
            'class-topic' => 'required|string|max:10',
            'class-description' => 'required|string|max:255',
            'class-code' => 'required|string|max:10|unique:lectures,code',
            'class-banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('class-banner');

        $path = $file ? $file->store('banners', 'public') : null;
        $url = $path ? Storage::url($path) : null;
        $lecture = ModelsLecture::create([
            'name' => $validate['class-name'],
            'topic' => $validate['class-topic'],
            'description' => $validate['class-description'],
            'code' => $validate['class-code'],
            'banner' => $url,
            'user_id' => Auth::id(),
        ]);

        $kelasUserRoles = KelasUserRoles::create([
            'lecture_id' => $lecture->id,
            'user_id' => Auth::id(),
            'role' => 'tentor', // Atur peran sebagai 'tentor'
        ]);

        return redirect()->route('lecture.show', $lecture->id)
            ->with('success', 'Kelas berhasil dibuat!');
    }

    public function codeCheck()
    {
        $validator = Validator::make(request()->all(), [
            'class-code' => 'required|string|max:10|unique:lectures,code',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first('class-code'),
            ]);
        }

        $codeToCheck = request()->input('class-code');

        $exist = ModelsLecture::where('code', $codeToCheck)->exists();

        return response()->json([
            'status' => 'success',
            'message' => 'Kode kelas tersedia.',
            'exists' => $exist,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showLecture(string $id)
    {
        $lecture = ModelsLecture::withCount('user') // Pertama, siapkan query dengan count
                    ->with('assignment')
                    ->findOrFail($id);   // Kemudian, ambil model berdasarkan ID

        $materi = materi::where('lecture_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $tugas = Assignment::where('lecture_id', $id)
            ->orderBy('created_at', 'desc') // Order at the database level
            ->get();

        $tugasTerbaru = Assignment::where('lecture_id', $id)
            ->orderBy('created_at', 'desc') // Order at the database level
            ->first();


        $materiTerbaru = materi::where('lecture_id', $id)
            ->orderBy('created_at', 'desc')
                ->first();

            // Cek apakah pengguna yang sedang login adalah tentor DI KELAS INI
        $isTentorInThisClass = Auth::user()->kelasRoles
            ->where('lecture_id', $lecture->id) // Filter berdasarkan ID kelas dari tugas ini
            ->where('role', 'tentor')
            ->isNotEmpty(); // Cek apakah hasilnya tidak kosong

        $pengumuman = Notice::where('lecture_id', $id)->orderBy('created_at', 'desc')->get();

        return view('lecture.show', compact(['lecture', 'materi', 'tugas', 'pengumuman', 'tugasTerbaru', 'materiTerbaru', 'isTentorInThisClass']));
    }

    public function joinLecture(Request $request) {
        $request->validate([
            'join-code' => 'required|string|max:7',
        ]);

        $code = $request->input('join-code');

        $lectureExist = ModelsLecture::where('code', $code)->first();

        if (!$lectureExist) {
            return redirect()->back()->with('error', 'Kode kelas tidak valid atau kelas tidak ditemukan.');
        }

        $lectureId = $lectureExist->id;

        $alreadyJoined = KelasUserRoles::where('lecture_id', $lectureId)
        ->where('user_id', Auth::id())->exists();

        if ($alreadyJoined) {
            Alert::warning('Tidak Bisa Bergabung', 'Anda sudah bergabung pada kelas ini.');
            return redirect()->back()->with('error', 'Anda sudah bergabung pada kelas ini.');
        }

        $gabung = KelasUserRoles::create([
            'lecture_id' => $lectureId,
            'user_id' => Auth::id(),
            'role' => 'siswa', // Atur peran sebagai 'siswa'
        ]);

        Alert::success('Success Title', 'Yeay! Kamu resmi jadi bagian dari kelas ini 🎉
        Jangan lupa cek materi dan mulai belajarnya ya!');


        return redirect()->route('lecture.show', $lectureId)
            ->with('success', 'Anda telah bergabung dengan kelas!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
