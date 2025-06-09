@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Pengumpulan Tugas</h1>
            <div class="text-sm text-gray-600">
                <span class="font-medium">Deadline:</span>
                <span class="bg-red-100 text-red-800 px-2 py-1 rounded ml-1">{{ $tugas->deadline->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <!-- Informasi Tugas -->
        <div class="bg-orange-400 rounded-lg shadow-md p-6 mb-8 text-white">
            <h2 class="text-2xl font-semibold mb-4">{{ $tugas->title }}</h2>
            <div class=" mb-4">
                <p>{{ $tugas->deskripsi }}</p>
            </div>
            <div class="flex flex-wrap gap-4 text-md">
                <div>
                    <span class="">Tentor:</span>
                    <span class="">{{ $tugas->lecture->tentor->name }}</span>
                </div>
                <div>
                    <span class=" ">Poin:</span>
                    <span class="">100</span>
                </div>
            </div>
        </div>

        <!-- Form Pengumpulan -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Form Pengumpulan</h2>

            <form action="{{ $isEdit ? route('tugas.updateSubmit', ['lecture' => $lecture, 'submission' => $submission, 'tugas' => $tugas]) : route('tugas.storeSubmit', ['lecture' => $lecture, 'tugas' => $tugas]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($isEdit)
                    @method('put')
                @endif
                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi/Komentar
                        <span class="text-gray-400 text-xs">(Opsional)</span>
                    </label>
                    <textarea id="description" name="submission-description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Tambahkan deskripsi atau komentar tentang tugas yang dikumpulkan...">{{ $isEdit ? $submission->description : '' }}</textarea>
                </div>

                <!-- Lampiran -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Lampiran File
                        <span class="text-red-500">*</span>
                    </label>

                    <!-- Dropzone Area -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center mb-4 transition-colors hover:border-orange-400">
                        <div class="flex flex-col items-center justify-center">
                            <!-- SVG Upload Icon -->
                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-sm text-gray-600 mb-1">Seret dan lepas file di sini atau</p>
                            <label for="file-upload" class="cursor-pointer bg-orange-50 text-orange-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-orange-100 transition-colors">
                                Pilih File
                            </label>
                            <input id="file-upload" name="submission-file" type="file" class="sr-only" {{ !$isEdit ? 'required' : '' }} accept=".pdf,.doc,.docx,.zip,.rar,.fig,.xd" onchange="previewFile(event)">
                        </div>
                    </div>

                    <!-- Persyaratan File -->
                    <div class="text-xs text-gray-500">
                        <p>Format file yang diterima: .pdf, .doc, .docx, .zip, .rar, .fig, .xd</p>
                        <p>Ukuran maksimal: 10MB</p>
                    </div>
                </div>

                <!-- File Terpilih (akan muncul setelah memilih file) -->
                <div class="w-full mb-6">
                    <h1 id="textPreview" class="{{ $isEdit && $submission->file_path ? 'block' : 'hidden' }} mb-2">File Terpilih :</h1>
                    <div id="previewDiv" class="flex gap-2 w-full">
                        @if ($isEdit && $submission->file_path)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="border rounded-lg p-3 flex items-center">
                                    <!-- SVG PDF Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $submission->original_fileName }}</p>
                                        <p class="text-sm text-gray-500">{{ $submission->formattedFileSize }}</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $tugas->file_path) }}" download class="text-orange-600 hover:text-orange-700 ml-auto">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>


                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3">
                    <a href="" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        {{ $isEdit ? 'Perbarui Tugas' : 'Kumpulkan Tugas' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        @vite(['resources/js/file-preview.js'])
    @endpush
@endsection
