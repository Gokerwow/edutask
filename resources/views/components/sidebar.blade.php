@props(['user'])

<aside
    class="w-72 bg-white text-gray-800 p-0 flex flex-col h-full shadow-sm rounded-xl border-r border-gray-200 md:block">
    {{-- Kontainer untuk Profil dan Menu Utama --}}
    <div class="flex-grow overflow-y-auto">
        {{-- Bagian Profil Pengguna di Sidebar --}}
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <div class="w-16 h-16 rounded-full border-4 border-orange-300 shadow-lg overflow-hidden">
                        @if ($user->avatar)
                            <img class="w-full h-full object-cover" src="{{ $user->avatar }}" alt="Profile" class="">
                        @else
                            <svg class="w-full h-full object-cover" viewBox="0 0 100 100"
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
                    </div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white">
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-600 truncate">{{ $user->email }}</p>
                    <a href="#" {{-- Ganti dengan route ke halaman edit profil --}}
                        class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">
                        Lihat Profil
                    </a>
                </div>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="py-4 px-3 space-y-1">
            <a href="#" {{-- Ganti # dengan route yang sesuai --}}
                class="flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors group font-medium">
                <i class="fas fa-tachometer-alt mr-3 w-5 h-5 text-gray-400 group-hover:text-indigo-600"></i>
                Dashboard
            </a>
            <a href="#" {{-- Ganti # dengan route('profile.show') atau sejenisnya --}}
                class="flex items-center px-3 py-2.5 bg-indigo-100 text-indigo-700 rounded-lg transition-colors group font-medium">
                {{-- Contoh Active State --}}
                <i class="fas fa-user-circle mr-3 w-5 h-5 text-indigo-600"></i>
                Profil Saya
            </a>
            <a href="#" {{-- Ganti # dengan route yang sesuai --}}
                class="flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors group font-medium">
                <i class="fas fa-book-open mr-3 w-5 h-5 text-gray-400 group-hover:text-indigo-600"></i>
                Mata Kuliah Saya
            </a>
            <a href="#" {{-- Ganti # dengan route yang sesuai --}}
                class="flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors group font-medium">
                <i class="fas fa-calendar-check mr-3 w-5 h-5 text-gray-400 group-hover:text-indigo-600"></i>
                Jadwal & Kehadiran
            </a>
            <a href="#" {{-- Ganti # dengan route yang sesuai --}}
                class="flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors group font-medium">
                <i class="fas fa-bullhorn mr-3 w-5 h-5 text-gray-400 group-hover:text-indigo-600"></i>
                Pengumuman
            </a>
            <a href="#" {{-- Ganti # dengan route yang sesuai --}}
                class="flex items-center px-3 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors group font-medium">
                <i class="fas fa-cog mr-3 w-5 h-5 text-gray-400 group-hover:text-indigo-600"></i>
                Pengaturan Akun
            </a>
        </nav>
    </div>

    {{-- Menu Tambahan/Logout di bagian bawah --}}
    <div class="p-3 border-t border-gray-200">
        <a href="#"
            class="flex items-center px-3 py-2.5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-lg transition-colors group font-medium">
            <i class="fas fa-question-circle mr-3 w-5 h-5 text-gray-400 group-hover:text-gray-600"></i>
            Pusat Bantuan
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center w-full mt-1 px-3 py-2.5 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors group font-medium">
                <span class="fas fa-sign-out-alt mr-3 w-5 h-5 text-red-500 group-hover:text-red-600"></span>
                Keluar
            </button>
        </form>
    </div>
</aside>
