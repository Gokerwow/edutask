@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Pengumuman</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('notice.update', [$lecture, $notice]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Isi Pengumuman</label>
                <textarea name="description" id="description" rows="8" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>{{ old('body', $notice->body) }}</textarea>
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('notice.show', [$lecture, $notice]) }}" class="px-6 py-2 border rounded-md text-gray-700">Batal</a>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
