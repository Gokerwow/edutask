@extends('layouts.main')

@section('content')
<main class="relative max-w-[1550px] min-h-screen m-auto px-4 sm:px-6 lg:px-8 py-8 ">
    <!-- Banner Kuliah -->
    <div class="relative max-w-full h-[500px] mb-8 rounded-xl overflow-hidden shadow-lg">
        <div class="absolute z-0 w-full h-full course-image overflow-hidden flex justify-center items-center bg-gradient-to-r from-blue-600 to-purple-600">
            <img class="hover:scale-110 transition duration-500 w-full h-full object-cover" src="{{ asset($lecture->banner) }}" alt="Banner {{ $lecture->name ?? 'Kuliah' }}">
        </div>
        <div class="relative z-10 w-full h-full flex flex-col justify-end p-8 text-white bg-gradient-to-t from-black/80 to-transparent">
            <div class="max-w-4xl">
                <span class="inline-block px-3 py-1 mb-4 text-sm font-semibold bg-white/20 rounded-full backdrop-blur-sm">{{ $lecture->code }}</span>
                <h1 class="text-4xl md:text-5xl font-bold mb-2">{{ $lecture->name }}</h1>
                <p class="text-lg opacity-90">{{ $lecture->description }}</p>
                <div class="flex items-center mt-4 space-x-4">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mathematics
                    </span>
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ $lecture->user_count }} Mahasiswa
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Menu -->
        <aside class="w-full lg:w-1/4">
            <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-[100px] ">
                <!-- Profil Dosen -->
                <div class="p-6 border-b">
                    <div class="flex items-center space-x-4">
                        <img class="w-12 h-12 rounded-full object-cover" src="{{ asset($lecture->tentor->avatar) }}" alt="{{ $lecture->tentor->name }}">
                        <div>
                            <h3 class="font-semibold">Tentor</h3>
                            <p class="text-sm text-gray-600">{{ $lecture->tentor->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Menu Navigasi -->
                <nav class="p-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="flex items-center px-4 py-3 rounded-lg bg-blue-50 text-blue-600 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Materi Pelajaran
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Tugas & Kuis
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Nilai & Penilaian
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Konten Utama -->
        <div class="w-full lg:w-3/4">
            <!-- Dashboard Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Materi Terbaru</h3>
                    <p class="text-xl font-semibold mb-2">{{ $materiTerbaru->name ?? 'Tidak Ada Materi Terbaru' }}</p>
                    @if($materiTerbaru !== null)
                        <p class="text-sm text-gray-500">Diupload {{ $materiTerbaru?->created_at->diffForHumans() }}</p>
                    @endif
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500">
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Tugas Terbaru</h3>
                    @if ($tugasTerbaru && $tugasTerbaru->count() > 0) {{-- atau !$tugasTerbaru->isEmpty() --}}
                        {{-- Sekarang aman untuk memanggil $tugasTerbaru->first() --}}
                        <p class="text-xl font-semibold mb-2">{{ $tugasTerbaru->first()->name }}</p>
                        <p class="text-sm text-gray-500">Deadline {{ $tugasTerbaru->sisa_waktu ?? 'Tidak Ada Materi Terbaru' }}</p>
                    @else
                        <p class="text-xl font-semibold mb-2">Tidak Ada Tugas Terbaru</p>
                    @endif
                </div>
                {{-- <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-purple-500">
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Nilai Rata-rata</h3>
                    <p class="text-3xl font-bold mb-1">85.5</p>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div> --}}
            </div>

            @livewire('class-content', ['tugasKuis' => $tugasKuis, 'materi' => $materi, 'pengumuman' => $pengumuman, 'lecture' => $lecture])

        </div>
    </div>
</main>
@endsection
