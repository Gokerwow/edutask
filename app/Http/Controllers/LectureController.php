<?php

namespace App\Http\Controllers;

use App\Models\KelasUserRoles;
use App\Models\Lecture as ModelsLecture;
use App\Models\Notice;
use App\Models\work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        //
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
