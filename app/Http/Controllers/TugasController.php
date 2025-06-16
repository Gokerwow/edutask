<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Lecture;
use App\Models\Submission;
use App\Models\work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTugas(Lecture $lecture)
    {
        $isEdit = false;
        return view('work.create-Tugas',compact('lecture', 'isEdit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTugas(Request $request, Lecture $lecture)
    {
        $validator = Validator::make($request->all(), [
            'tugas-title' => 'required|string|max:255',
            'tugas-description' => 'required|string|max:500',
            'tugas-deadline' => 'required|date|max:500',
            'tugas-file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,png,mp4|max:2048',
        ]);

        if ($validator->fails()) {
            $errorList = '<ul>';
            foreach ($validator->errors()->all() as $error) {
                $errorList .= '<li>' . e($error) . '</li>';
            }
            $errorList .= '</ul>';

            Alert::error('Oops! Terjadi Kesalahan', $errorList)->toHtml();
            return redirect()->back()->withInput();
        }

        $filePath = $request->file('tugas-file') ? $request->file('tugas-file')->store('tugas_files', 'public') : null;
        $originalFileName = $filePath ? $request->file('tugas-file')->getClientOriginalName() : null;
        if ($filePath && !$originalFileName) {
            Alert::error('Oops! Terjadi Kesalahan', 'Gagal mendapatkan nama file asli.')->toHtml();
            return redirect()->back()->withInput();
        }


        $tugasBaru = Assignment::create([
            'title' => $request->input('tugas-title'),
            'description' => $request->input('tugas-description'),
            'deadline' => $request->input('tugas-deadline'),
            'file_path' => $filePath,
            'original_fileName' => $originalFileName,
            'lecture_id' => $lecture->id,
        ]);

        Alert::success('Sukses', 'Tugas berhasil dibuat!');

        return redirect()->route('tugas.show', [$lecture, $tugasBaru])->with('success', 'Tugas berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function showTugas(Lecture $lecture, Assignment $tugas)
    {
        if ($tugas->lecture_id !== $lecture->id) {
            abort(404);
        }
        // Cek apakah pengguna yang sedang login adalah tentor DI KELAS INI
        $isTentorInThisClass = Auth::user()->kelasRoles
            ->where('lecture_id', $lecture->id) // Filter berdasarkan ID kelas dari tugas ini
            ->where('role', 'tentor')
            ->isNotEmpty(); // Cek apakah hasilnya tidak kosong

        $submissionExists = $tugas->submissions()
            ->where('user_id', Auth::id())
            ->first();

        $submissions = $tugas->submissions()
            ->where('assignment_id', $tugas->id)
            ->get();



        return view('work.tugas-show', [
            'lecture' => $lecture,
            'tugas' => $tugas,
            'isTentorInThisClass' => $isTentorInThisClass,
            'submissionExists' => $submissionExists,
            'submissions' => $submissions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTugas(Lecture $lecture, Assignment $tugas)
    {
        $formattedSize = null; // Siapkan variabel dengan nilai default null

        // Cek apakah tugas ini memiliki file dan file tersebut ada di storage
        if ($tugas->file_path && Storage::disk('public')->exists($tugas->file_path)) {
            // Ambil ukuran file dalam bytes
            $sizeInBytes = Storage::disk('public')->size($tugas->file_path);
            // Format ukurannya agar mudah dibaca
            $formattedSize = $this->formatBytes($sizeInBytes);
        }

        $isEdit = true;
        return view('work.create-Tugas', [
            'lecture' => $lecture,
            'tugas' => $tugas,
            'isEdit' => $isEdit,
            'fileSize' => $formattedSize
        ]);
    }

    private function formatBytes($bytes, $precision = 2)
    {
        if ($bytes === 0) return '0 Bytes';
        $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTugas(Request $request, Lecture $lecture, Assignment $tugas)
    {
        $validator = Validator::make($request->all(), [
            'tugas-title' => 'required|string|max:255',
            'tugas-description' => 'required|string|max:500',
            'tugas-deadline' => 'required|date|max:500',
            'tugas-file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,png,mp4|max:2048',
        ]);

        if ($validator->fails()) {
            $errorList = '<ul>';
            foreach ($validator->errors()->all() as $error) {
                $errorList .= '<li>' . e($error) . '</li>';
            }
            $errorList .= '</ul>';

            Alert::error('Oops! Terjadi Kesalahan', $errorList)->toHtml();
            return redirect()->back()->withInput();
        }

        $filePath = $tugas->file_path; // Default ke file lama
        $originalFileName = $tugas->original_fileName; // Default ke nama file lama

        if ($request->hasFile('tugas-file')) {
            // Hapus file lama jika ada
            if ($tugas->file_path) {
                Storage::disk('public')->delete($tugas->file_path);
            }

            $filePath = $request->file('tugas-file') ? $request->file('tugas-file')->store('tugas_files', 'public') : null;
            $originalFileName = $filePath ? $request->file('tugas-file')->getClientOriginalName() : null;

            if ($filePath && !$originalFileName) {
                Alert::error('Oops! Terjadi Kesalahan', 'Gagal mendapatkan nama file asli.')->toHtml();
                return redirect()->back()->withInput();
            }
        }

        // Update tugas
        $tugas->update([
            'title' => $request->input('tugas-title'),
            'description' => $request->input('tugas-description'),
            'deadline' => $request->input('tugas-deadline'),
            'file_path' => $filePath,
            'original_fileName' => $originalFileName,
        ]);

        Alert::success('Sukses', 'Tugas berhasil diperbarui!');

        return redirect()->route('tugas.show', [$lecture, $tugas])->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyTugas(Lecture $lecture, Assignment $tugas)
    {
        $tugas->delete();

        Alert::success('Berhasil Dihapus', 'Tugas Berhasil Dihapus!');

        return redirect()->route('lecture.show', [
            'lecture' => $lecture,
        ]);
    }

}
