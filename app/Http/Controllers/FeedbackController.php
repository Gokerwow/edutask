<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FeedbackController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'feedback' => $request->feedback,
        ]);

        Alert::success('Berhasil', 'Feedback berhasil dikirim!');
        return redirect()->route('feedback.index');
    }

    public function showForm() {
        return view('feedback.formFeedback');
    }

    public function index() {
        $feedbacks = Feedback::with('user')->latest()->simplePaginate(10); // mengambil feedback beserta user-nya
        return view('feedback.indexFeedback', compact('feedbacks'));
    }
}
