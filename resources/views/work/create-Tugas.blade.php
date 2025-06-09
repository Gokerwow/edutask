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
                    <div id="previewDiv" class="flex gap-2 w-full">
                        @if ($isEdit && $tugas->file_path)
                            <div
                                class="mt-2 p-2 w-fit flex items-center text-sm text-gray-500 bg-gray-300 rounded-lg gap-2">
                                <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                    fill="#e74c3c">
                                    <path
                                        d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.3 10.7 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-30 19.7-43.4-13.1-15.9-30.4-28.8-49.8-35.6zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z" />
                                </svg>
                                <div class="flex flex-col items-center gap-2">
                                    <span id="file-name text-sm">{{ $tugas->original_fileName }}</span>
                                    <span class="text-xs text-gray-500" id="file-size">{{ $fileSize ?? 'Ukuran tidak diketahui' }}</span>
                                </div>
                                <svg id="deleteFilePreview" class="w-5 h-5 cursor-pointer"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000">
                                    <path
                                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3 pt-4 border-t border-orange-100">
                    <button type="button"
                        class="px-6 py-2 border border-orange-200 rounded-md text-orange-700 bg-orange-50 hover:bg-orange-100 transition duration-200">
                        Batal
                    </button>
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
