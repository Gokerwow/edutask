<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Lecture;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function destroy(string $id)
    {
        //
    }
}
