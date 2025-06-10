@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold ">Buat Tugas/Kuis Baru</h1>
        </div>

        <!-- Form Create Tugas/Kuis -->
        <div class="bg-white rounded-lg shadow-md p-6 border border-orange-100">
            <form action="{{ $isEdit ? route('tugas.update', ['lecture' => $lecture, 'tugas' => $tugas]) : route('tugas.store', ['lecture' => $lecture]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif
                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium mb-2">Judul Tugas</label>
                    <input type="text" id="judul" name="tugas-title"
                        class="w-full px-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 "
                        placeholder="Masukkan judul tugas" value="{{ $isEdit ? $tugas->title : '' }}" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium  mb-2">Instruksi</label>
                    <textarea id="deskripsi" rows="3" name="tugas-description"
                        class="w-full px-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 "
                        placeholder="Berikan instruksi untuk tugas" required>{{ $isEdit ? $tugas->description : '' }}</textarea>
                </div>

                <!-- Tanggal dan Waktu -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="deadline" class="block text-sm font-medium  mb-2">Batas Waktu Pengumpulan</label>
                        <input type="date" id="deadline" name="tugas-deadline"
                            value="{{ $isEdit ? $tugas->deadline->format('Y-m-d') : '' }}"
                            class="w-full px-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 cursor-pointer">
                    </div>
                </div>

                <!-- Lampiran -->
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">File Pendukung (Opsional)</label>
                    <div class="border-2 border-dashed border-orange-200 rounded-md p-4 text-center bg-orange-50">
                        <i class="fas fa-paperclip text-xl text-orange-400 mb-2"></i>
                        <p class=" mb-2">Unggah file pendukung jika diperlukan</p>
                    <input type="file" class="hidden" name="tugas-file" id="file-upload" value="{{ $isEdit ? $tugas->file_path : '' }}">
                        <button type="button" onclick="document.getElementById('file-upload').click()"
                            class="px-4 py-2 bg-orange-100 text-orange-600 rounded-md hover:bg-orange-200 transition duration-200">
                            Pilih File
                        </button>
                    </div>
                    <div class="mt-2 text-sm text-gray-500">Format yang didukung: PDF, PPT, DOC, JPG, PNG, MP4</div>
                </div>

                <div class="w-full mb-6">
                    <h1 id="textPreview" class="{{ $isEdit && $tugas->file_path ? 'block' : 'hidden' }} mb-2">File Terpilih :</h1>
                    <div id="previewDiv" class="flex gap-2 w-full">
                        @if ($isEdit && $tugas->file_path)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="border rounded-lg p-3 flex items-center">
                                    <!-- SVG PDF Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $tugas->original_fileName }}</p>
                                        <p class="text-sm text-gray-500">{{ $tugas->formattedFileSize }}</p>
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
                <div class="flex justify-end gap-3 pt-4 border-t border-orange-100">
                    <a href="{{ url()->previous() }}"
                        class="px-6 py-2 border border-orange-200 rounded-md text-orange-700 bg-orange-50 hover:bg-orange-100 transition duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition duration-200">
                        {{ $isEdit ? 'Konfirmasi Edit' : 'Publikasikan Tugas'}}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        @vite(['resources/js/file-preview.js'])
    @endpush
@endsection
