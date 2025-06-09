<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MateriController extends Controller
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
    public function createMateri(Lecture $lecture)
    {
        return view('work.create-materi', compact('lecture'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMateri(Request $request, Lecture $lecture)
    {
        $validator =  Validator::make($request->all(), [
            'materi-title' => 'required|string|max:255',
            'materi-description' => 'required|string|max:500',
            'materi-file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,png,mp4|max:2048',
        ]);

        // 2. Cek apakah validasi gagal
        if ($validator->fails()) {
            // 3. Jika gagal, format semua pesan error menjadi daftar HTML
            $errorList = '<ul>';
            foreach ($validator->errors()->all() as $error) {
                $errorList .= '<li>' . e($error) . '</li>'; // e() untuk escaping demi keamanan
            }
            $errorList .= '</ul>';

            // 4. Panggil Alert::error() dengan pesan HTML
            Alert::error('Oops! Terjadi Kesalahan', $errorList)->toHtml();

            // 5. Lakukan redirect kembali ke halaman form
            return redirect()->back()->withInput();
        }

        $filePath = $request->file('materi-file') ? $request->file('materi-file')->store('materi_files', 'public') : null;

        $originalFileName = $filePath ? $request->file('materi-file')->getClientOriginalName() : null;

        $lectureID = $lecture->id;
        $materiBaru = materi::create([
            'lecture_id' => $lectureID, // Assuming you have a lecture_id in the request
            'title' => $request->input('materi-title'),
            'description' => $request->input('materi-description'),
            'file_path' => $filePath,
            'original_fileName' => $originalFileName
        ]);

        Alert::success('Success', 'Materi Berhasil Dibuat.');

        // Logic to store the materi data
        // For example, you can save it to the database

        return redirect()->route('materi.show', [$lecture, $materiBaru])->with('success', 'Materi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function showMateri(Lecture $lecture, materi $materi)
    {
        // Pastikan materi ini benar-benar milik lecture tersebut (untuk keamanan tambahan)
        if ($materi->lecture_id !== $lecture->id) {
            abort(404);
        }
        return view('work.materi-show', [
            'lecture' => $lecture,
            'materi' => $materi
        ]);
    }

    public function downloadMateri(Lecture $lecture, materi $materi)
    {
        // 1. (Opsional) Verifikasi Keamanan Tambahan
        // Route Model Binding sudah memastikan relasinya, tapi jika ingin lebih yakin
        if ($materi->lecture_id !== $lecture->id) {
            abort(404); // Tampilkan halaman tidak ditemukan jika tidak cocok
        }

        $relativePath = $materi->file_path;

        // TAMBAHKAN PENGECEKAN INI
        if (!$relativePath || !Storage::disk('public')->exists($relativePath)) {
            // Beri pesan error yang jelas jika file tidak ada di storage
            abort(404, 'File fisik tidak ditemukan di storage.');
        }

        // Jika kode lolos dari pengecekan di atas, berarti file ada dan bisa diakses.
        // Sekarang kita bisa mencoba mengunduhnya.

        $absolutePath = Storage::disk('public')->path($relativePath);
        $originalName = $materi->original_filename;

        return response()->download($absolutePath, $originalName);
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
