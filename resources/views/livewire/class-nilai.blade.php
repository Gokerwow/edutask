<div class="w-full">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Nilai Kelas - {{ $lecture->name }}</h1>
            <p class="text-gray-600">Rekapitulasi Nilai Partisipan</p>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Cari siswa...">
            </div>
            <div class="flex space-x-3">
                <select
                    class="px-3 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option>Urutkan Berdasarkan</option>
                    <option>Nama A-Z</option>
                    <option>Nama Z-A</option>
                    <option>Nilai Tertinggi</option>
                    <option>Nilai Terendah</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Daftar Nilai (Card-based) -->
    {{-- Pastikan Alpine.js sudah di-load di layout utama Anda --}}

    @if ($gradesPerUser && $gradesPerUser->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach ($gradesPerUser as $gradesInfo)
                {{-- ====================================================== --}}
                {{-- 1. KARTU INFORMASI SISWA (TETAP SAMA) --}}
                {{-- ====================================================== --}}
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 flex flex-col">
                    <div class="p-5 flex-grow">
                        <div class="flex items-center mb-4">
                            @if ($gradesInfo->user_avatar)
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ $gradesInfo->user_avatar }}"
                                    alt="Foto siswa">
                            @else
                                {{-- SVG Avatar Placeholder --}}
                                <svg class="w-12 h-12 rounded-full overflow-hidden" viewBox="0 0 100 100"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="g-{{ $gradesInfo->user_id }}" x1="100%" y1="0%"
                                            x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#f97316" />
                                            <stop offset="100%" stop-color="#7e22ce" />
                                        </linearGradient>
                                    </defs>
                                    <circle cx="50" cy="50" r="45"
                                        fill="url(#g-{{ $gradesInfo->user_id }})" />
                                    <circle cx="50" cy="40" r="15" fill="#ffffff" />
                                    <circle cx="50" cy="85" r="25" fill="#ffffff" />
                                </svg>
                            @endif
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-900">{{ $gradesInfo->user_name }}</h3>
                                <p class="text-sm text-gray-500">{{ $gradesInfo->user_email }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Nilai Akhir</p>
                                <p class="text-2xl font-bold">{{ $gradesInfo->average_grade }}</p>
                            </div>
                            <div>
                                <span
                                    class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">{{ $gradesInfo->letter_grade ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 px-5 py-3 bg-gray-50 flex justify-end">
                        {{-- ====================================================== --}}
                        {{-- 2. TOMBOL UNTUK MEMICU MODAL YANG SPESIFIK --}}
                        {{-- ====================================================== --}}
                        <button x-data @click="$dispatch('open-modal', 'detail-modal-{{ $gradesInfo->user_id }}')"
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                {{-- ====================================================== --}}
                {{-- 3. MODAL SPESIFIK UNTUK SETIAP SISWA DALAM LOOP --}}
                {{-- ====================================================== --}}
                <x-modal name="detail-modal-{{ $gradesInfo->user_id }}" maxWidth="4xl">
                    <div class="p-6 bg-white">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Detail Nilai Siswa</h2>
                                <p class="text-gray-600">Rekapitulasi nilai tugas dan aktivitas</p>
                            </div>
                            <button @click="$dispatch('close')" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="bg-slate-50 rounded-xl shadow-sm p-6 mb-8">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                    @if ($gradesInfo->user_avatar)
                                        <img src="{{ $gradesInfo->user_avatar }}" alt="Avatar"
                                            class="w-full h-full object-cover">
                                    @else
                                        {{-- SVG Avatar Placeholder --}}
                                        <svg class="w-12 h-12 rounded-full overflow-hidden" viewBox="0 0 100 100"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="gm-{{ $gradesInfo->user_id }}" x1="100%"
                                                    y1="0%" x2="0%" y2="100%">
                                                    <stop offset="0%" stop-color="#f97316" />
                                                    <stop offset="100%" stop-color="#7e22ce" />
                                                </linearGradient>
                                            </defs>
                                            <circle cx="50" cy="50" r="45"
                                                fill="url(#gm-{{ $gradesInfo->user_id }})" />
                                            <circle cx="50" cy="40" r="15" fill="#ffffff" />
                                            <circle cx="50" cy="85" r="25" fill="#ffffff" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $gradesInfo->user_name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $gradesInfo->user_email }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Kartu Statistik (jika ada datanya di $gradesInfo) --}}

                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Rincian Tugas</h3>
                        <div class="overflow-x-auto border rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Tugas</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Deadline</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Nilai</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($gradesInfo->assignments as $assignment)
                                        @php
                                            $userSubmission = $assignment->submissions->first();
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $assignment->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $assignment->deadline->format('d M Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($userSubmission)
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tuntas</span>
                                                @else
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Belum
                                                        Mengerjakan</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                {{ $userSubmission->grade ?? '–' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada
                                                tugas yang diberikan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6 text-right">
                            <button @click="$dispatch('close')"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Tutup</button>
                        </div>
                    </div>
                </x-modal>
            @endforeach
        </div>
    @else
        <p>Tidak ada data nilai untuk ditampilkan.</p>
    @endif

    <!-- Statistik Nilai -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-gray-500 text-sm font-medium mb-1">Nilai Rata-rata Kelas</h3>
            <p class="text-3xl font-bold mb-1">{{ $avg_grade }}</p>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $avg_grade }}%"></div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-gray-500 text-sm font-medium mb-1">Nilai Tertinggi</h3>
            <p class="text-3xl font-bold mb-1">{{ $highestGrade->grade ?? '0' }}</p>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $highestGrade->grade ?? '0' }}%"></div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-gray-500 text-sm font-medium mb-1">Nilai Terendah</h3>
            <p class="text-3xl font-bold mb-1">{{ $lowestGrade->grade ?? '0' }}</p>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-red-600 h-2 rounded-full" style="width: {{ $lowestGrade->grade ?? '0' }}%"></div>
            </div>
        </div>
    </div>
</div>
