<div class="w-full">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Partisipan Kelas</h1>
            <p class="text-gray-600">Manajemen peserta kelas pembelajaran</p>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white p-4 rounded-lg shadow-sm mb-6 w-full">
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
                    placeholder="Cari peserta...">
            </div>
        </div>
    </div>

    <!-- Tabel Partisipan -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Peserta</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($participants as $key => $participant)
                        <!-- Peserta 1 -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if ($participant->user->avatar)
                                            <img src="{{ $participant->user->avatar }}" alt="Avatar"
                                                class="w-full h-full object-cover object-center rounded-full"
                                                referrerPolicy="no-referrer">
                                        @else
                                            <svg class="w-10 h-10" viewBox="0 0 100 100"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <defs>
                                                    <linearGradient id="circleGradient" x1="100%" y1="0%"
                                                        x2="0%" y2="100%">
                                                        <stop offset="0%" stop-color="#f97316" />
                                                        <stop offset="100%" stop-color="#7e22ce" />
                                                    </linearGradient>
                                                </defs>
                                                <circle cx="50" cy="50" r="45"
                                                    fill="url(#circleGradient)" />
                                                <circle cx="50" cy="40" r="15" fill="#ffffff" />
                                                <circle cx="50" cy="85" r="25" fill="#ffffff" />
                                            </svg>
                                        @endif

                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $participant->user->name }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $participant->user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $participant->user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ strtoupper($participant->role ?? 'Status Tidak Tersedia') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                <button class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
