<?php

namespace App\Http\Controllers;

use App\Models\KelasUserRoles;
use App\Models\Lecture as ModelsLecture;
use App\Models\Notice;
use App\Models\work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
                    ->with('work')
                    ->findOrFail($id);   // Kemudian, ambil model berdasarkan ID

                    $materi = $lecture->work->filter(function($item) {
            return $item->type === 'materi';
        });

        $tugasKuis = $lecture->work->filter(function($item) {
            return $item->type === 'tugas' || $item->type === 'kuis';
        });

        $tugasTerbaru = $lecture->work() // Call work as a method to get the Query Builder
            ->where('type', 'tugas')    // Filter at the database level
            ->orderBy('created_at', 'desc') // Order at the database level
            ->first();

        $kuisTerbaru = $lecture->work()
            ->where('type', 'tugas')    // Filter at the database level
            ->orderBy('created_at', 'desc') // Order at the database level
            ->first();

        $materiTerbaru = $lecture->work()
            ->where('type', 'materi')    // Filter at the database level
            ->orderBy('created_at', 'desc') // Order at the database level
            ->first();


        $pengumuman = Notice::where('lecture_id', $id)->orderBy('created_at', 'desc')->get();

        return view('lecture.show', compact(['lecture', 'materi', 'tugasKuis', 'pengumuman', 'tugasTerbaru', 'kuisTerbaru', 'materiTerbaru']));
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
