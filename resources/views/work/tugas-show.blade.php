@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Detail Tugas</h1>
            <!-- Tombol Kembali -->
            <a href="{{ route('lecture.show', ['id' => $lecture->id]) }}">
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center">
                    <!-- SVG Arrow Left Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke Daftar Tugas
                </button>
            </a>
        </div>

        <!-- Card Detail Tugas -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">Tugas</span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-2">{{ $tugas->title }}</h2>
                    </div>
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Selesai</span>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600 mb-4">
                        {{ $tugas->description }}
                    </p>

                    <div class="flex items-center text-gray-500 mb-2">
                        <!-- SVG Calendar Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <span>Deadline: {{ $tugas->deadline->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center text-gray-500">
                        <!-- SVG User Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <span>Ditugaskan Oleh: {{ $tugas->lecture->name }}</span>
                    </div>
                </div>

                @if($tugas->file_path)
                    <!-- Lampiran -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Lampiran</h3>
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
                                <a href="{{ asset('storage/' . $tugas->file_path) }}" download class="text-orange-600 hover:text-orange-700 ml-auto">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if($isTentorInThisClass)
                <div class="flex space-x-3 w-full bg-gray-100 p-6 justify-end">
                    <a href="{{ route('tugas.edit', ['lecture' => $lecture, 'tugas' => $tugas]) }}">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                            <!-- SVG Edit Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit
                        </button>
                    </a>
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
                        <!-- SVG Trash Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Hapus
                    </button>
                </div>
            @else
                @if($submissionExists)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Tugas Anda</h2>

                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Deskripsi:</h3>
                            <p class="text-gray-600 bg-gray-50 p-3 rounded">{{ $submissionExists->description ?? '-' }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">File Tugas:</h3>
                            <div class="flex items-center justify-between bg-gray-50 p-3 rounded-md">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">{{ $submissionExists->original_fileName }}</p>
                                        <p class="text-xs text-gray-500">{{ $submissionExists->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                                <a href="{{ $submissionExists->file_path }}" download class="text-orange-600 hover:text-orange-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('tugas.editSubmit', ['lecture' => $lecture, 'submission' => $submissionExists, 'tugas' => $tugas]) }}" class="px-4 py-2 border border-orange-600 text-orange-600 rounded-md text-sm font-medium hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                Submit Ulang Tugas
                            </a>
                        </div>
                    </div>
                @else
                    @if(!($tugas->deadline < now()))
                        <div class="flex space-x-3 w-full bg-gray-100 p-6 justify-end" >
                            <a href="{{ route('tugas.submit', ['lecture' => $lecture, 'tugas' => $tugas]) }}" class="px-4 py-2 gap-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 20 8 14 8"/>
                                    <path d="M12 18v-6"/>
                                    <path d="m15 15-3-3-3 3"/>
                                </svg>
                                <span>Submit Tugas</span>
                            </a>
                        </div>
                    @else
                        <div class="flex space-x-3 w-full bg-gray-100 p-6 justify-end" >
                            <button type="button" class="px-4 py-2 gap-2 bg-red-300 text-red-800 rounded-lg hover:text-red-50 hover:bg-red-500 transition duration-300 flex items-center cursor-not-allowed" disabled>
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Waktu Sudah Habis</span>
                            </button>
                        </div>
                    @endif
                @endif
            @endif


        </div>


    </div>
@endsection
