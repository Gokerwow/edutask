<main class="relative w-[1550px] min-h-screen m-auto px-4 sm:px-6 lg:px-8 py-8 ">
    <!-- Banner Kuliah -->
    <div class="relative max-w-full h-[500px] mb-8 rounded-xl overflow-hidden shadow-lg">
        <div
            class="absolute z-0 w-full h-full course-image overflow-hidden flex justify-center items-center bg-gradient-to-r from-blue-600 to-purple-600">
            @if ($lecture->banner)
                <img class="hover:scale-110 transition duration-500 w-full h-full object-cover"
                    src="{{ asset($lecture->banner) }}" alt="Banner {{ $lecture->name ?? 'Kelas' }}">
            @endif
        </div>
        <div
            class="relative z-10 w-full h-full flex flex-col justify-end p-8 text-white bg-gradient-to-t from-black/80 to-transparent">
            <div class="max-w-4xl">
                <span
                    class="inline-block px-3 py-1 mb-4 text-sm font-semibold bg-white/20 rounded-full backdrop-blur-sm">{{ $lecture->code }}</span>
                <h1 class="text-4xl md:text-5xl font-bold mb-2">{{ $lecture->name }}</h1>
                <p class="text-lg opacity-90">{{ $lecture->description }}</p>
                <div class="flex items-center mt-4 space-x-4">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ $userCount }} Partisipan
                    </span>
                </div>
            </div>
            @if ($isTentorInThisClass)
                <div class="absolute z-10 top-4 right-4">
                    <a href="{{ route('lecture.edit', ['lecture' => $lecture]) }}"
                        class="flex items-center px-4 py-2 bg-white/90 hover:bg-white text-gray-800 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Kelas
                    </a>
                </div>
            @endif
        </div>

    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Menu -->
        <aside class="w-full lg:w-1/4">
            <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-[100px] ">
                <!-- Profil Dosen -->
                <div class="p-6 border-b">
                    <div class="flex items-center space-x-4">
                        @if ($lecture->tentor->avatar)
                            <img class="w-12 h-12 rounded-full object-cover" src="{{ asset($lecture->tentor->avatar) }}"
                                alt="{{ $lecture->tentor->name }}">
                        @else
                            <svg class="w-12 h-12 rounded-full overflow-hidden" viewBox="0 0 100 100"
                                xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="circleGradient" x1="100%" y1="0%" x2="0%"
                                        y2="100%">
                                        <stop offset="0%" stop-color="#f97316" />
                                        <stop offset="100%" stop-color="#7e22ce" />
                                    </linearGradient>
                                </defs>
                                <circle cx="50" cy="50" r="45" fill="url(#circleGradient)" />
                                <circle cx="50" cy="40" r="15" fill="#ffffff" />
                                <circle cx="50" cy="85" r="25" fill="#ffffff" />
                            </svg>
                        @endif
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
                            <a href="#" wire:click='active("dashboard")'
                                class="flex items-center px-4 py-3 rounded-lg {{ $activeMainTab === 'dashboard' ? 'bg-indigo-50 text-indigo-600' : 'hover:bg-gray-100 text-gray-700' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" wire:click='active("nilaiTab")'
                                class="flex items-center px-4 py-3 rounded-lg {{ $activeMainTab === 'nilaiTab' ? 'bg-indigo-50 text-indigo-600' : 'hover:bg-gray-100 text-gray-700' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Nilai & Penilaian
                            </a>
                        </li>
                        <li>
                            <a href="#" wire:click='active("partisipanTab")'
                                class="flex items-center px-4 py-3 rounded-lg {{ $activeMainTab === 'partisipanTab' ? 'bg-indigo-50 text-indigo-600' : 'hover:bg-gray-100 text-gray-700' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                    </path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1">
                                    </rect>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path d="M12 14v3"></path>
                                    <path d="m14.5 15.5-2.5 2.5-2.5-2.5"></path>
                                </svg>
                                Partisipan Kelas
                            </a>
                        </li>
                        <li>
                            <form class="delete-form" action="{{ route('lecture.out', $lecture) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    Keluar Kelas
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Konten Utama -->
        <div class="w-full lg:w-3/4">
            @if ($activeMainTab === 'dashboard')
                @livewire('class-content', ['tugas' => $tugas, 'materi' => $materi, 'pengumuman' => $pengumuman, 'lecture' => $lecture, 'isTentorInThisClass' => $isTentorInThisClass, 'materiTerbaru' => $materiTerbaru, 'tugasTerbaru' => $tugasTerbaru])
            @elseif($activeMainTab === 'partisipanTab')
                @livewire('class-participant', ['lecture' => $lecture])
            @elseif($activeMainTab === 'nilaiTab')
                @if ($isTentor)
                    @livewire('class-nilai', ['lecture' => $lecture, 'tugas' => $tugas])
                @else
                    @livewire('class-detailNilai', ['lecture' => $lecture, 'tugas' => $tugas])
                @endif
            @endif
        </div>
    </div>
</main>
