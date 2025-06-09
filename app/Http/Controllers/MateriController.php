<?php

namespace App\Http\Controllers;

use App\Models\KelasUserRoles;
use App\Models\Lecture;
use App\Models\materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $isEdit = false;
        return view('work.create-materi', compact('lecture', 'isEdit'));
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

        $isTentor = KelasUserRoles::where('lecture_id', $lecture->id)
            ->where('user_id', Auth::id())
            ->where('role', 'tentor')
            ->exists();

        return view('work.materi-show', [
            'lecture' => $lecture,
            'materi' => $materi,
            'isTentor' => $isTentor,
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
    public function editMateri(Lecture $lecture, materi $materi)
    {

        $isEdit = true; // Setel variabel ini untuk menandakan bahwa ini adalah mode edit
        return view('work.create-materi', [
            'lecture' => $lecture,
            'materi' => $materi,
            'isEdit' => $isEdit,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateMateri(Request $request, Lecture $lecture, materi $materi)
    {
        $validator = Validator::make($request->all(), [
            'materi-title' => 'required|string|max:255',
            'materi-description' => 'required|string|max:500',
            'materi-file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,png,mp4|max:2048',
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

        $filePath = $materi->file_path; // Simpan path file lama
        $originalFileName = $materi->original_filename;


        if ($request->hasFile('materi-file')) {
            // Hapus file lama jika ada
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }
            // Simpan file baru
            $filePath = $request->file('materi-file')->store('materi_files', 'public');
            $originalFileName = $request->file('materi-file')->getClientOriginalName();
        }

        $materi->update([
            'title' => $request->input('materi-title'),
            'description' => $request->input('materi-description'),
            'file_path' => $filePath,
            'original_filename' => $originalFileName,
            'lecture_id' => $lecture->id // Pastikan materi ini terkait dengan lecture yang benar
        ]);

        Alert::success('Success', 'Materi Berhasil Diperbarui.');

        return redirect()->route('materi.show', [$lecture, $materi])->with('success', 'Materi updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
