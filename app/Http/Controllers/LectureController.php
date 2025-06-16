<?php

namespace App\Http\Controllers;

use App\Livewire\Lecture;
use App\Models\Assignment;
use App\Models\KelasUserRoles;
use App\Models\Lecture as ModelsLecture;
use App\Models\materi;
use App\Models\Notice;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $validate = Validator::make($request->all(), [
            'class-name' => 'required|string|max:255',
            'class-topic' => 'required|string|max:10',
            'class-description' => 'required|string|max:255',
            'class-code' => 'required|string|max:10|unique:lectures,code',
            'class-banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            $errorList = '<ul>';
            foreach ($validate->errors()->all() as $error) {
                $errorList .= '<li>' . e($error) . '</li>';
            }
            $errorList .= '</ul>';

            Alert::error('Oops! Terjadi Kesalahan', $errorList)->toHtml();
            return redirect()->back()->withInput();
        };

        $validatedData = $validate->validated();

        $file = $request->file('class-banner');

        $path = $file ? $file->store('banners', 'public') : null;
        $url = $path ? Storage::url($path) : null;
        $lecture = ModelsLecture::create([
            'name' => $validatedData['class-name'],
            'topic' => $validatedData['class-topic'],
            'description' => $validatedData['class-description'],
            'code' => $validatedData['class-code'],
            'banner' => $url,
            'user_id' => Auth::id(),
        ]);

        $kelasUserRoles = KelasUserRoles::create([
            'lecture_id' => $lecture->id,
            'user_id' => Auth::id(),
            'role' => 'tentor', // Atur peran sebagai 'tentor'
        ]);

        Alert::success('Success', 'Kelas Berhasil Dibuat.');

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

    public function joinLecture(Request $request)
    {
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

        KelasUserRoles::create([
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

    public function exitLecture(string $id)
    {
        // 1. Dapatkan user yang sedang login.
        $user = Auth::user();

        // 2. Cari data lecture untuk mendapatkan namanya terlebih dahulu.
        // Lakukan ini sebelum menghapus apa pun untuk menghindari error.
        $lecture = ModelsLecture::find($id);

        // Jika kelas tidak ditemukan sama sekali, kembalikan dengan error.
        if (!$lecture) {
            Alert::error('Gagal', 'Kelas yang Anda tuju tidak ditemukan.');
            return redirect()->route('lecture.index');
        }
        $lectureName = $lecture->name;

        // 3. Cari entri partisipasi user di kelas ini (cukup satu kali query).
        // Gunakan first() untuk mendapatkan satu objek, bukan collection.
        $participation = KelasUserRoles::where('lecture_id', $id)
            ->where('user_id', $user->id)
            ->first();

        // 4. Jika user tidak terdaftar di kelas ini, beri notifikasi.
        if (!$participation) {
            Alert::warning('Info', 'Anda memang tidak terdaftar di kelas: ' . $lectureName);
            return redirect()->route('lecture.index');
        }

        // 5. Periksa role pengguna (logika yang lebih aman).
        if ($participation->role === 'tentor') {
            // Logika aman: Jangan hapus kelas, tapi beri pesan bahwa tentor tidak bisa keluar.
            // Ini mencegah siswa lain kehilangan kelasnya.
            // Alert::error('Aksi Ditolak', 'Sebagai Tentor, Anda tidak dapat keluar dari kelas. Silakan hapus kelas jika sudah tidak digunakan.');

            // --- (CATATAN) JIKA ANDA TETAP INGIN TENTOR MENGHAPUS KELAS SAAT KELUAR ---
            // Ini adalah logika yang SANGAT BERBAHAYA. Pastikan Anda benar-benar menginginkannya.
            // Disarankan untuk membungkusnya dalam Transaction.
            DB::transaction(function () use ($participation, $lecture) {
                $participation->delete(); // Operasi 1: Hapus peran tentor
                $lecture->delete();       // Operasi 2: Hapus kelasnya
            });
        }

        // 6. Jika bukan tentor (misalnya role 'siswa'), hapus partisipasinya.
        $participation->delete();

        // 7. Berikan notifikasi sukses dan arahkan kembali.
        Alert::success('Berhasil Keluar', 'Anda telah keluar dari kelas: ' . $lectureName);
        return redirect()->route('lecture.index');
    }
}
