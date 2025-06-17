<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class NoticeController extends Controller
{
    public function show(Lecture $lecture, Notice $notice)
    {
        // $notice->load('user', 'comments.user');
        $notice->load('lecture.tentor', 'comments.user');
        return view('notice.show', compact('lecture', 'notice'));
    }

    public function edit(Lecture $lecture, Notice $notice)
    {
        // if ($notice->lecture->user->first()->id !== Auth::id()) {
        if ($notice->lecture->tentor->id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan untuk mengedit pengumuman ini.');
        }
        return view('notice.form-notice', compact('lecture', 'notice'));
    }

    public function update(Request $request, Lecture $lecture, Notice $notice)
    {
        // if ($notice->lecture->user->first()->id !== Auth::id()) {
        if ($notice->lecture->tentor->id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan untuk mengedit pengumuman ini.');
        }

        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:1000'
        ]);

        $validated_data = $validator->validated();

        if ($validator->fails()) {
            $errorList = '<ul>';
            foreach ($validator->errors()->all() as $error) {
                $errorList .= '<li>' . e($error) . '</li>';
            }
            $errorList .= '</ul>';

            Alert::error('Oops! Terjadi Kesalahan', $errorList)->toHtml();
            return redirect()->back()->withInput();
        };

        $notice->update([
            'description' => $validated_data['description']
        ]);


        Alert::success('Berhasil', 'Pengumuman berhasil diperbarui!');
        return redirect()->route('notice.show', [$lecture, $notice]);
    }

    public function storeComment(Request $request, Lecture $lecture, Notice $notice)
    {
        $request->validate([
            'comment_body' => 'required|string',
        ]);

        $notice->comments()->create([
            'comment' => $request->input('comment_body'),
            'user_id' => Auth::id(),
        ]);

        Alert::success('Berhasil', 'Komentar Anda telah ditambahkan.');
        return redirect()->route('notice.show', [$lecture, $notice]);
    }
}
