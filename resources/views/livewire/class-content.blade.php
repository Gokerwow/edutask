<div class="w-full">
    <!-- Dashboard Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-indigo-500">
            <h3 class="text-gray-500 text-sm font-medium mb-1">Materi Terbaru</h3>
            <p class="text-xl font-semibold mb-2">{{ $materiTerbaru->title ?? 'Tidak Ada Materi Terbaru' }}</p>
            @if ($materiTerbaru !== null)
                <p class="text-sm text-gray-500">Diupload {{ $materiTerbaru?->created_at->diffForHumans() }}</p>
            @endif
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-orange-500">
            <h3 class="text-gray-500 text-sm font-medium mb-1">Tugas Terbaru</h3>
            @if ($tugasTerbaru && $tugasTerbaru->count() > 0)
                {{-- atau !$tugasTerbaru->isEmpty() --}}
                {{-- Sekarang aman untuk memanggil $tugasTerbaru->first() --}}
                <p class="text-xl font-semibold mb-2">{{ $tugasTerbaru->title }}</p>
                <p class="text-sm text-gray-500">Deadline {{ $tugasTerbaru->sisa_waktu ?? 'Tidak Ada Materi Terbaru' }}
                </p>
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

    <!-- Filter dan Konten -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <!-- Tab Navigasi -->
        <div class="border-b">
            <nav class="flex -mb-px">
                <button wire:click="active('materiTab')"
                    class="px-6 py-4 border-b-2 font-medium text-sm transition-all duration-300 {{ $activeTab === 'materiTab' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Materi Kelas
                </button>
                <button wire:click="active('tugasTab')"
                    class="px-6 py-4 border-b-2 font-medium text-sm transition-all duration-300 {{ $activeTab === 'tugasTab' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} ">
                    Tugas & Kuis
                </button>
                <button wire:click="active('forumTab')"
                    class="px-6 py-4 border-b-2 font-medium text-sm transition-all duration-300 {{ $activeTab === 'forumTab' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} ">
                    Forum
                </button>
            </nav>
        </div>

        <!-- Filter -->
        @if ($activeTab !== 'forumTab')
            <div class="p-4 border-b flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="w-full md:w-auto">
                    <label for="search" class="sr-only">Cari</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms='queries' id="search" name="search"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="{{ $activeTab === 'materiTab' ? 'Cari Materi...' : 'Cari Tugas...' }}"
                            type="search">
                    </div>
                </div>

                <div class="flex items-center space-x-4 w-full md:w-auto">
                    @if ($isTentorInThisClass)
                        <div
                            class="flex items-center px-4 py-2 {{ $activeTab === 'materiTab' ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-orange-600 hover:bg-orange-700' }} text-white rounded-lg ">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M6 12H18M12 6V18" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            <a href="{{ $activeTab === 'materiTab' ? route('materi.create', ['lecture' => $lecture->id]) : route('tugas.create', ['lecture' => $lecture->id]) }}"
                                class="">
                                {{ $activeTab === 'materiTab' ? 'Buat Materi Baru' : 'Buat Tugas baru' }}
                            </a>
                        </div>
                    @endif
                    <div>
                        <label for="sort" class="sr-only">Urutkan</label>
                        <select id="sort" name="sort"
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option>Terbaru</option>
                            <option>Terlama</option>
                            <option>A-Z</option>
                            <option>Z-A</option>
                        </select>
                    </div>
                    <div>
                        <label for="filter" class="sr-only">Filter</label>
                        <select id="filter" name="filter"
                            class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option>Semua Materi</option>
                            <option>Video</option>
                            <option>Dokumen</option>
                            <option>Slide</option>
                            <option>Link Eksternal</option>
                        </select>
                    </div>
                </div>
            </div>
        @endif

        @if ($activeTab === 'materiTab')
            <!-- Daftar Materi -->
            <div class="divide-y divide-gray-200">
                @forelse ($searchWork as $task)
                    <!-- Item Materi -->
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('materi.show', ['lecture' => $lecture, 'materi' => $task]) }}"
                                        class="text-lg cursor-pointer font-medium text-gray-900">{{ $task->title }}</a>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Baru
                                    </span>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">{{ $task->description }}</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Diupload pada {{ $task->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak Ada Materi</h3>
                        <p class="mt-1 text-sm text-gray-500">Saat ini belum ada Materi dari tentor.</p>
                    </div>
                @endforelse
            </div>
        @elseif($activeTab === 'tugasTab')
            <!-- Daftar Materi -->
            <div class="divide-y divide-gray-200">
                @forelse ($searchWork as $task)
                    <!-- Item Materi -->
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('tugas.show', ['lecture' => $lecture, 'tugas' => $task]) }}"
                                        class="text-lg font-medium text-gray-900">{{ $task->title }}</a>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Baru
                                    </span>
                                </div>
                                <p class="mt-1 text-sm text-gray-500"> {{ $task->description }} </p>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Diupload pada {{ $task->created_at->format('d M Y') }}
                                </div>
                                <div class="mt-3 flex space-x-3">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-blue-100 text-blue-800">
                                        Tugas
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak Ada Tugas atau Kuis</h3>
                        <p class="mt-1 text-sm text-gray-500">Saat ini belum ada Tugas atau Kuis dari tentor.</p>
                    </div>
                @endforelse
            </div>
        @elseif($activeTab === 'forumTab')
            <div class="divide-y divide-gray-200">
                @if ($isTentorInThisClass)
                <div class="flex-1 p-6">
                    <form wire:submit="storeNotice">
                        {{-- HANYA ADA TEXTAREA, INPUT JUDUL DIHAPUS --}}
                        <textarea wire:model="newNoticeDescription" placeholder="Mulai forum baru..."
                            class="w-full px-3 py-2 border rounded-md focus:outline-indigo-500 @error('newNoticeDescription') border-red-500 @enderror"
                            rows="3"></textarea>
                        @error('newNoticeDescription')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror

                        {{-- Tombol Submit --}}
                        <div class="text-right mt-3">
                            <button type="submit"
                                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50">
                                Publikasikan
                            </button>
                        </div>
                    </form>
                </div>
                @endif
                {{-- Asumsi variabel $pengumuman berisi collection/array pengumuman --}}
                @forelse ($pengumuman as $item)
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 rounded-full bg-amber-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.34 3.07a1.016 1.016 0 011.32 0l3.31 3.311a1.016 1.016 0 010 1.32C13.97 8.712 12 10.28 12 12.5V12.5a8.25 8.25 0 00-2.933 16.044A8.25 8.25 0 0012 21.75V21.75c0 2.22-.97 3.788-1.97 4.799a1.016 1.016 0 01-1.32 0L5.399 23.238a1.016 1.016 0 010-1.32c1.002-1.001 2.132-2.607 2.132-4.909V17a8.25 8.25 0 005.14-13.93zM10.34 3.07L6.03 7.381M15 9l-2.25 2.25M15 9l2.25 2.25M15 9v10.5M7.5 12h9M7.5 15h9" />
                                </svg>
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900 w-1/2 truncate">
                                        {{ $item->description }}</h3>
                                    <div>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 mr-2">
                                            Pengumuman
                                        </span>
                                        {{-- @if ($item->is_important) --}}
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Penting
                                        </span>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{-- Ganti dengan Str::limit($item->content, 150) jika menggunakan Laravel --}}
                                    {{-- {{ substr($item->content, 0, 150) }}{{ strlen($item->content) > 150 ? '...' : '' }} --}}
                                </p>
                                <div class="mt-3 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Diposting oleh {{ $item->lecture->tentor->name }}
                                        <span class="mx-1.5">&bull;</span>
                                        {{ $item->created_at->format('d M Y') }}
                                    </div>
                                    <div class="mt-3 sm:mt-0">
                                        <a href="{{ route('notice.show', [$lecture, $item]) }}"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak Ada Pengumuman</h3>
                        <p class="mt-1 text-sm text-gray-500">Saat ini belum ada pengumuman dari tentor.</p>
                    </div>
                @endforelse
            </div>
        @endif
    </div>

    <!-- Detail Kelas -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold">Detail Kelas - {{ $lecture->name }}</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <!-- Informasi Umum Kelas -->
            <div class="p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-medium text-gray-900">Deskripsi Kelas</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ $lecture->description }}
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500">Tentor</p>
                                <p class="text-sm">{{ $lecture->tentor->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500">Kode Kelas</p>
                                <p class="text-sm">{{ $lecture->code }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Materi Pembelajaran -->
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Materi Pembelajaran</h3>
                <div class="space-y-3">
                    @forelse ($materi as $materi)
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-5 w-5 text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="ml-2 text-sm text-gray-600">{{ $materi->title }}</p>
                    </div>
                    @empty
                    <div class="flex items-center">
                        <div class="h-5 w-5 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 512 512">
                                <circle cx="256" cy="256" r="256" fill="#EF4444" />
                                <path fill="#FFFFFF" d="M342.6 169.4c-9.4-9.4-24.6-9.4-33.9 0L256 222.1l-52.7-52.7c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9L222.1 256l-52.7 52.7c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0L256 289.9l52.7 52.7c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9L289.9 256l52.7-52.7c9.5-9.4 9.5-24.6 0-33.9z"/>
                            </svg>
                        </div>
                        <p class="ml-2 text-sm text-gray-600">Belum ada materi yang diupload nih.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
