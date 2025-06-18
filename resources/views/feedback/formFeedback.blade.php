@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded-lg">
    <h2 class="text-3xl font-bold mb-4 text-center text-gray-800">Berikan Feedback</h2>
    <p class="text-gray-600 mb-6 text-center">Masukan Anda sangat berarti untuk membantu kami menyempurnakan aplikasi ini.</p>

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">Tulis Feedback:</label>
        <textarea name="feedback" id="feedback" class="w-full border border-gray-300 rounded-md p-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required maxlength="1000" rows="8" style="width: calc(100% + 2rem); margin-left: -1rem; margin-right: -1rem;"></textarea>

        <button type="submit" class="mt-4 w-full px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition duration-200">
            Kirim
        </button>
    </form>
</div>
@endsection
