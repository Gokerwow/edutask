@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Detail Materi</h1>
            <a href="{{ route('lecture.show', ['lecture' => $lecture]) }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali Ke Daftar Materi
            </a>
        </div>

        <!-- Card Materi -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header Card -->
            <div class="bg-indigo-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">{{ $materi->title }}</h2>
                <p class="text-blue-100 text-sm mt-1">Diposting pada: {{ $materi->created_at->format('d M Y') }}</p>
            </div>

            <!-- Konten Materi -->
            <div class="p-6">
                <!-- Deskripsi -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-800 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $materi->title }}
                    </h3>
                    <div class="prose max-w-none text-gray-700">
                        <p>{{ $materi->description }}</p>
                    </div>
                </div>

                <!-- Lampiran -->
                @if ($materi->file_path && $materi->original_fileName)
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Lampiran
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- File PDF -->
                            <div
                                class="border border-gray-200 rounded-md p-4 hover:bg-gray-50 transition flex items-center">
                                <div class="mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500"
                                        viewBox="0 0 384 512" fill="currentColor">
                                        <path
                                            d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.3 10.7 24 24 24z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">{{ $materi->original_fileName }}</h4>
                                    <p class="text-sm text-gray-500">{{ $materi->formattedFileSize }}</p>
                                    <a href="{{ route('materi.download', ['lecture' => $lecture, 'materi' => $materi]) }}"
                                        class="mt-2 text-sm text-indigo-600 hover:text-indigo-800 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            @if ($isTentor)
                <!-- Footer Card -->
                <div class="bg-gray-50 px-6 py-4 border-t flex justify-end gap-2">
                    <a href="{{ route('materi.edit', ['lecture' => $lecture, 'materi' => $materi]) }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-blue-700 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Materi
                    </a>
                    <form class="delete-form"
                        action="{{ route('materi.delete', ['lecture' => $lecture->id, 'materi' => $materi->id]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
                            Hapus
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/confirmMateriDelete.js')
    @endpush
@endsection
