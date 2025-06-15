@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">{{ $isEdit ? 'Edit Materi' : 'Buat Materi Baru' }}</h1>
        </div>

        <!-- Form Create Materi -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ $isEdit ? route('materi.update', ['lecture' => $lecture, 'materi' => $materi]) : route('materi.store', ['lecture' => $lecture]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($isEdit)
                    @method('put')
                @endif
                <!-- Judul Materi -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Materi</label>
                    <input type="text" id="judul"
                        name="materi-title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan judul materi"
                        value="{{ $isEdit ? $materi->title : '' }}" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Materi</label>
                    <textarea id="deskripsi" rows="3"
                        name="materi-description"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Tambahkan deskripsi singkat tentang materi ini">{{ $isEdit ? $materi->description : '' }}</textarea>
                </div>

                <!-- Lampiran -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lampiran</label>
                    <div class="border-2 border-dashed border-indigo-300 bg-indigo-50 rounded-md p-6 text-center">
                        <svg class="w-12 h-12 place-self-center text-gray-400 mb-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor">
                            <path d="M537.6 226.6c4.1-10.7 6.4-22.4 6.4-34.6 0-53-43-96-96-96-19.7 0-38.1 6-53.3 16.2C367 64.2 315.3 32 256 32c-88.4 0-160 71.6-160 160 0 2.7.1 5.4.2 8.1C40.2 219.8 0 273.2 0 336c0 79.5 64.5 144 144 144h368c70.7 0 128-57.3 128-128 0-61.9-44-113.6-102.4-125.4zM393.4 288H328v112c0 8.8-7.2 16-16 16h-48c-8.8 0-16-7.2-16-16V288h-65.4c-14.3 0-21.4-17.2-11.3-27.3l105.4-105.4c6.2-6.2 16.4-6.2 22.6 0l105.4 105.4c10.1 10.1 2.9 27.3-11.3 27.3z"/>
                        </svg>
                        <p class="text-gray-500">Seret dan lepas file di sini atau klik untuk mengunggah</p>
                        <input type="file" class="hidden" id="file-upload" name="materi-file">
                        <button type="button" onclick="document.getElementById('file-upload').click()"
                            class="mt-3 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-md hover:bg-indigo-100">
                            Pilih File
                        </button>
                    </div>
                    <div class="mt-2 text-sm text-gray-500">Format yang didukung: PDF, PPT, DOC, JPG, PNG, MP4</div>
                    <div id="previewDiv" class="flex gap-2 w-full">
                        @if ($isEdit && $materi->file_path)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="border rounded-lg p-3 flex items-center">
                                    <!-- SVG PDF Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $materi->original_fileName }}</p>
                                        <p class="text-sm text-gray-500">{{ $materi->formattedFileSize }}</p>
                                    </div>
                                    <button type="button" id="deleteFilePreview" class="text-orange-600 hover:text-orange-700 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ $isEdit? route('materi.show', ['lecture' => $lecture, 'materi' => $materi]) : route('lecture.show', ['lecture' => $lecture->id]) }}"
                        class="px-6 py-2 border border-indigo-200 rounded-md text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition duration-200">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-blue-700">
                        Publikasikan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        @vite(['resources/js/file-preview.js'])
    @endpush
@endsection
