<nav class="h-18 w-full h-[80px] flex items-center justify-between px-40 bg-white shadow-md fixed z-[99]">
    <div class="h-full flex justify-center items-center w-36 overflow-hidden">
        <img class="w-[150px]" src="{{ asset('images/logo/edutaskLOGO.png') }}" alt="">
    </div>
    <ul class="flex h-full gap-2">
        <li class="nav-item flex items-center relative px-6 py-5 h-full cursor-pointer hover:text-white transition-colors duration-500">
            <a href=""><span class="relative z-10 text-lg">Home</span></a>
        </li>
        <li class="nav-item flex items-center relative px-6 py-5 h-full cursor-pointer hover:text-white transition-colors duration-500">
            <a href=""><span class="relative z-10 text-lg">About</span></a>
        </li>
        <li class="nav-item flex items-center relative px-6 py-5 h-full cursor-pointer hover:text-white transition-colors duration-500">
            <a href="{{ route('lecture.index') }}"><span class="relative z-10 text-lg">Classes</span></a>
        </li>
    </ul>
    <div class="flex space-x-4">
        @auth
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <button @click="open = !open" class="flex items-center space-x-2 bg-white text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">
                    @if(auth()->user()->avatar)
                        <div class="w-12 h-12 rounded-full overflow-hidden">
                            <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-full h-full object-cover object-center" referrerPolicy="no-referrer">
                        </div>
                    @else
                        <div class="w-12 h-12 rounded-full overflow-hidden">
                            <img src="{{ asset('images/avatars/yuna.jpg') }}" alt="Avatar" class="w-full h-full object-cover object-center">
                        </div>
                    @endif

                    <span>{{ auth()->user()->name }}</span>
                </button>

                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-72 bg-white text-gray-900 rounded-xl shadow-xl z-50 border border-gray-200"
                >
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-full h-full object-cover object-center">
                            </div>
                            <div>
                                <div class="font-semibold">{{ auth()->user()->name }}</div>
                                <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 space-y-4">
                        <div>
                            <button class="flex items-center space-x-2 text-sm text-blue-600 hover:underline">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.94 7.28a8 8 0 1011.31 11.31l4.36 4.36a1 1 0 001.41-1.41l-4.36-4.36a8 8 0 00-11.31-11.31zM10 18a8 8 0 110-16 8 8 0 010 16z"/></svg>
                                <span>Give Feedback</span>
                            </button>
                            <p class="text-xs text-gray-500 ml-6">Bantu Kami Menyempurnakan EduTask</p>
                        </div>

                        <ul class="space-y-2 text-sm">
                            <li>
                                <a href="{{ route('profile') }}" class="flex items-center justify-between hover:text-purple-500">
                                    <span class="flex items-center gap-2"><i class="fas fa-cog"></i> Settings & Privacy</span>
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-between hover:text-purple-500">
                                    <span class="flex items-center gap-2"><i class="fas fa-question-circle"></i> Help & Support</span>
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-between hover:text-purple-500">
                                    <span class="flex items-center gap-2"><i class="fas fa-palette"></i> Display & Theme</span>
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 hover:text-purple-500">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-palette"></i> Logout
                                        </span>
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="cursor-pointer px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-opacity-75 transition duration-150 ease-in-out">
                Login
            </a>

            <a href="{{ route('register') }}" class="cursor-pointer px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-75 transition duration-150 ease-in-out">
                Register
            </a>
        @endguest
    </div>
</nav>
