@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Detail Tugas</h1>
            <!-- Tombol Kembali -->
            <a href="{{ route('lecture.show', ['lecture' => $lecture->id]) }}">
                <button
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center">
                    <!-- SVG Arrow Left Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
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
                        <span
                            class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">Tugas</span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-2">{{ $tugas->title }}</h2>
                    </div>
                    <span
                        class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Selesai</span>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600 mb-4">
                        {{ $tugas->description }}
                    </p>

                    <div class="flex items-center text-gray-500 mb-2">
                        <!-- SVG Calendar Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Deadline: {{ $tugas->deadline->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center text-gray-500">
                        <!-- SVG User Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Ditugaskan Oleh: {{ $tugas->lecture->name }}</span>
                    </div>
                </div>

                @if ($tugas->file_path)
                    <!-- Lampiran -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Lampiran</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="border rounded-lg p-3 flex items-center">
                                <!-- SVG PDF Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 mr-3"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $tugas->original_fileName }}</p>
                                    <p class="text-sm text-gray-500">{{ $tugas->formattedFileSize }}</p>
                                </div>
                                <a href="{{ asset('storage/' . $tugas->file_path) }}" download
                                    class="text-orange-600 hover:text-orange-700 ml-auto">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if ($isTentorInThisClass)
                <div class="flex space-x-3 w-full bg-gray-100 p-6 justify-end">
                    <a href="{{ route('tugas.edit', ['lecture' => $lecture, 'tugas' => $tugas]) }}">
                        <button
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
                            <!-- SVG Edit Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit
                        </button>
                    </a>
                    <form class="delete-form" action="{{ route('tugas.delete', ['lecture' => $lecture, 'tugas' => $tugas]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
                            <!-- SVG Trash Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
                @if (!$submissions->isEmpty())
                    <div x-data="{ submissionAction: '' }" class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Tugas Yang Telah Dikumpulkan</h2>

                        {{-- Tabel untuk menampilkan data --}}
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Mahasiswa
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Deskripsi
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            File Tugas
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Tanggal Kirim
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Asumsi $all_submissions adalah collection yang dikirim dari controller --}}
                                    @foreach ($submissions as $submission)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            {{-- Kolom Mahasiswa (Avatar, Nama, Email) --}}
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 rounded-full border-2 border-orange-200 shadow-sm overflow-hidden flex-shrink-0">
                                                        @if ($submission->user->avatar)
                                                            <img class="w-full h-full object-cover"
                                                                src="{{ $submission->user->avatar }}" alt="Profile">
                                                        @else
                                                            {{-- SVG Avatar Default --}}
                                                            <svg class="w-full h-full object-cover" viewBox="0 0 100 100"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <defs>
                                                                    <linearGradient id="circleGradient" x1="100%"
                                                                        y1="0%" x2="0%" y2="100%">
                                                                        <stop offset="0%" stop-color="#f97316" />
                                                                        <stop offset="100%" stop-color="#7e22ce" />
                                                                    </linearGradient>
                                                                </defs>
                                                                <circle cx="50" cy="50" r="45"
                                                                    fill="url(#circleGradient)" />
                                                                <circle cx="50" cy="40" r="15"
                                                                    fill="#ffffff" />
                                                                <circle cx="50" cy="85" r="25"
                                                                    fill="#ffffff" />
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="font-medium text-gray-900">
                                                            {{ $submission->user->name }}</div>
                                                        <div class="text-gray-400">{{ $submission->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Kolom Deskripsi --}}
                                            <td class="px-6 py-4">
                                                {{ $submission->description ?? '-' }}
                                            </td>

                                            {{-- Kolom File Tugas --}}
                                            <td class="px-6 py-4 font-medium text-gray-800">
                                                {{ $submission->original_fileName }}
                                            </td>

                                            {{-- Kolom Tanggal Kirim --}}
                                            <td class="px-6 py-4">
                                                {{ $submission->created_at->format('d M Y, H:i') }}
                                            </td>

                                            {{-- Kolom Aksi (Download & Nilai) --}}
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center gap-4">
                                                    {{-- Tombol Download --}}
                                                    <a href="{{ Storage::url($submission->file_path) }}" download
                                                        title="Download Tugas" class="text-blue-600 hover:text-blue-800">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    {{-- Tombol Nilai Tugas --}}
                                                    <button title="Beri Nilai" x-data
                                                        x-on:click="submissionAction = '{{ route('tugas.beriNilai', ['lecture' => $lecture, 'tugas' => $tugas, 'submission' => $submission]) }}';
                                                        $dispatch('open-modal', 'nilaiTugasModal');"
                                                        class="px-3 py-2 border border-orange-600 text-orange-600 rounded-md text-xs font-medium hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                                        {{ $submission->grade ? 'Ubah Nilai' : 'Nilai' }}
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <x-modal class="relative" name="nilaiTugasModal" maxWidth="md">
                                <div
                                    class="z-30 p-8 bg-white w-full max-w-md m-auto flex-col flex justify-center rounded-lg shadow-lg">
                                    <button class="absolute top-0 right-0 mt-4 mr-4 text-gray-400 hover:text-gray-600">
                                        <svg @click="show = false" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <div class="text-center">
                                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Beri Nilai Siswa</h3>
                                        <p class="text-sm text-gray-500 mb-6">Berikan Nilai Siswa Berdasarkan Tugas Yang
                                            Sudah Dikumpulkan</p>
                                    </div>

                                    <form :action="submissionAction" action="" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="">
                                            <label for="submission-grade"
                                                class="block text-sm font-medium text-gray-700 mb-1">
                                                Nilai
                                            </label>

                                            <div
                                                class="mt-1 flex items-center justify-between w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus-within:ring-1 focus-within:ring-indigo-500 focus-within:border-indigo-500">

                                                <input type="number" name="submission-grade" id="submission-grade"
                                                    min="0" max="100" value="{{ $submission->grade ?? '' }}"
                                                    class="flex-grow border-none p-0 focus:ring-0 sm:text-sm"
                                                    placeholder="Masukkan nilai" required>

                                                <span class="text-gray-500 pl-2">/100</span>
                                            </div>
                                        </div>


                                        <div class="mt-2">
                                            <label for="class_code"
                                                class="block text-sm font-medium text-gray-700 mb-1">Beri Komentar
                                                (opsional)</label>
                                            <input type="text" name="submission-comment" id="submission-comment"
                                                value="{{ $submission->comment ?? '' }}"
                                                class="mt-1 truncate block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                placeholder="Masukkan Komentar">
                                        </div>

                                        <div class="mt-6">
                                            <button type="submit"
                                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Berikan Nilai
                                            </button>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <button type="button" x-data
                                                x-on:click="$dispatch('close-modal', 'nilaiTugasModal')"
                                                class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </x-modal>
                        </div>
                    </div>
                @endif
            @else
                @if ($submissionExists && is_null($submissionExists->deleted_at))
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Tugas Anda</h2>

                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Deskripsi:</h3>
                            <p class="text-gray-600 bg-gray-50 p-3 rounded">
                                {{ $submissionExists->description ?? '-' }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">File Tugas:</h3>
                            <div class="flex items-center justify-between bg-gray-50 p-3 rounded-md">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">
                                            {{ $submissionExists->original_fileName }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $submissionExists->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                                <a href="{{ $submissionExists->file_path }}" download
                                    class="text-orange-600 hover:text-orange-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            @if ($tugas->deadline && now()->lessThan($tugas->deadline))
                                {{-- Gunakan Flexbox untuk mensejajarkan tombol dan beri jarak --}}
                                <div class="flex items-center gap-3 mt-3">

                                    {{-- Tombol 1: Batalkan Pengumpulan (Form) --}}
                                    <form
                                        class="delete-form"
                                        action="{{ route('submission.destroy', ['lecture' => $lecture, 'tugas' => $tugas, 'submission' => $submissionExists]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Batalkan Pengumpulan
                                        </button>
                                    </form>

                                    {{-- Tombol 2: Submit Ulang (Link) - Gayanya disamakan --}}
                                    <a href="{{ route('tugas.editSubmit', ['lecture' => $lecture, 'submission' => $submissionExists, 'tugas' => $tugas]) }}"
                                        class="inline-block px-4 py-2 border border-orange-600 text-orange-600 rounded-md text-sm font-medium hover:bg-orange-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                        Submit Ulang Tugas
                                    </a>
                                </div>
                            @else
                                <p class="text-sm font-semibold text-gray-600 mt-3">Tindakan tidak diizinkan (tugas sudah
                                    dinilai atau melewati deadline).</p>
                            @endif

                        </div>
                    </div>
                @else
                    @if (!($tugas->deadline < now()))
                        <div class="flex space-x-3 w-full bg-gray-100 p-6 justify-end">
                            <a href="{{ route('tugas.submit', ['lecture' => $lecture, 'tugas' => $tugas]) }}"
                                class="px-4 py-2 gap-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 20 8 14 8" />
                                    <path d="M12 18v-6" />
                                    <path d="m15 15-3-3-3 3" />
                                </svg>
                                <span>Submit Tugas</span>
                            </a>
                        </div>
                    @else
                        <div class="flex space-x-3 w-full bg-gray-100 p-6 justify-end">
                            <button type="button"
                                class="px-4 py-2 gap-2 bg-red-300 text-red-800 rounded-lg hover:text-red-50 hover:bg-red-500 transition duration-300 flex items-center cursor-not-allowed"
                                disabled>
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Waktu Sudah Habis</span>
                            </button>
                        </div>
                    @endif
                @endif
            @endif
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/confirmTugasDelete.js')
        @vite('resources/js/confirmBatalTugas.js')
    @endpush
@endsection
