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
    @if($gradesPerUser)

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach ($gradesPerUser as $key => $gradesInfo)
            <!-- Siswa 1 -->
            <div
                class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex items-center mb-4">
                        @if ($gradesInfo->user_avatar)
                            <img class="h-12 w-12 rounded-full object-cover" src="{{ $gradesInfo->user_avatar }}"
                                alt="Foto siswa">
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
                                class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">{{ $gradesInfo->letter_grade ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 px-5 py-3 bg-gray-50 flex justify-end space-x-3">
                    <a href="{{ route('lecture.detailNilai') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Detail</a>
                </div>
            </div>
        @endforeach
    </div>
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
