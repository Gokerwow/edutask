<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Lecture;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SubmissionController extends Controller
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
    public function createSubmission(Lecture $lecture, Assignment $tugas)
    {
        $submissionExist = Submission::where('assignment_id', $tugas->id)
            ->where('user_id', Auth::id())
            ->get();

        if (!$submissionExist->isEmpty()) {
            abort(404);
        }

        $isEdit = false;
        return view('work.submission', [
            'lecture' => $lecture,
            'tugas' => $tugas,
            'isEdit' => $isEdit,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSubmission(Request $request, Lecture $lecture, Assignment $tugas)
    {

        $validator = Validator::make($request->all(), [
            'submission-description' => 'nullable|string|max:500',
            'submission-file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,png,mp4|max:2048',
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

        $filePath = $request->file('submission-file') ? $request->file('submission-file')->store('submissions', 'public') : null;
        $fileName = $filePath ? $request->file('submission-file')->getClientOriginalName() : null;

        Submission::create([
            'description' => $request->input('submission-description', ''),
            'file_path' => $filePath,
            'original_fileName' => $fileName,
            'status' => 'submitted', // Default status
            'assignment_id' => $tugas->id,
            'user_id' => Auth::id(), // Assuming the user is authenticated
        ]);

        Alert::success('Berhasil', 'Tugas Berhasil Dikumpulkan');

        return redirect()->route('tugas.show', [
            'lecture' => $lecture,
            'tugas' => $tugas,
        ])
            ->with('success', 'Submission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSubmission(Lecture $lecture, Assignment $tugas, Submission $submission)
    {
        $isEdit = true;

        return view('work.submission', [
            'lecture' => $lecture,
            'tugas' => $tugas,
            'submission' => $submission,
            'isEdit' => $isEdit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSubmission(Request $request, Lecture $lecture, Assignment $tugas, Submission $submission)
    {
        $validator = Validator::make($request->all(), [
            'submission-description' => 'nullable|string|max:500',
            'submission-file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,png,mp4|max:10240',
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

        if ($request->hasFile('submission-file')) {
            $filePath = $request->file('submission-file')->store('submissions', 'public');
            $fileName = $request->file('submission-file')->getClientOriginalName();
        } else {
            $filePath = $submission->file_path;
            $fileName = $submission->original_fileName;
        }

        $submission->update([
            'description' => $request->input('submission-description', ''),
            'file_path' => $filePath,
            'original_fileName' => $fileName,
        ]);

        Alert::success('Berhasil', 'Tugas Berhasil Diperbarui');

        return redirect()->route('tugas.show', [
            'lecture' => $lecture,
            'tugas' => $tugas,
        ])
            ->with('success', 'Submission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture, Assignment $tugas, Submission $submission)
    {
        // Ambil data terkait untuk otorisasi
        $lecture = $tugas->lecture;
        $user = Auth::user();

        // Variabel untuk menandai apakah penghapusan diizinkan
        $canDelete = false;

        // Skenario 1: Pengguna adalah Tentor di kelas ini
        if ($user->id === $lecture->user_id) {
            $canDelete = true;
        }

        // Skenario 2: Pengguna adalah Mahasiswa pemilik submission
        if ($user->id === $submission->user_id) {
            // Mahasiswa hanya bisa hapus jika belum dinilai DAN belum deadline
            if ($submission->grade === 0 && now()->lessThan($tugas->deadline)) {
                $canDelete = true;
            }
        }

        // Jika tidak diizinkan, hentikan proses
        if (!$canDelete) {
            Alert::error('Gagal', 'Tugas Sudah Dinilai, Anda tidak diizinkan untuk menghapus pengumpulan ini.');
            return redirect()->back();
        }

        // Jika diizinkan, lanjutkan proses penghapusan
        try {
            // Hapus file dari storage terlebih dahulu jika ada
            if ($submission->file_path && Storage::disk('public')->exists($submission->file_path)) {
                Storage::disk('public')->delete($submission->file_path);
            }

            // Hapus record dari database
            $submission->update([
                'status' => 'cancelled',
                'deleted_at' => now(),
            ]);


            Alert::success('Berhasil', 'Pengumpulan tugas telah dihapus.');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.');
            return redirect()->back();
        }
    }

    public function beriNilai(Request $request, Lecture $lecture, Assignment $tugas, Submission $submission)
    {
        $validator = Validator::make($request->all(), [
            'submission-grade' => 'required|string|max:100',
            'submission-comment' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            $errorList = '<ul>';
            foreach ($validator->errors()->all() as $error) {
                $errorList .= '<li>' . e($error) . '</li>';
            }
            $errorList .= '</ul>';

            Alert::error('Oops! Terjadi Kesalahan', $errorList)->toHtml();
            return redirect()->back()->withInput();
        };

        $validated_data = $validator->validated();

        $submission->update([
            'status' => 'graded',
            'grade' => $validated_data['submission-grade'],
            'lecturer_comment' => $validated_data['submission-comment'],
            'graded_at' => now(),
        ]);

        Alert::success('Berhasil', 'Nilai telah berhasil disimpan.');

        return redirect()->back();
    }
}
