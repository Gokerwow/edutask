@extends('layouts.main')

@section('content')
    <div class="max-w-7xl flex gap-9 mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <x-sidebar :user="$user" />
        <div>
            <!-- Profile Header -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="gradient-bg h-32 sm:h-40"></div>
                <div class="px-6 pb-6">
                    <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 sm:-mt-20">
                        <div class="relative">
                            <div
                                class="w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg overflow-hidden">
                                @if ($user->avatar)
                                    <img class="w-full h-full object-cover" src="{{ $user->avatar }}" alt="Profile"
                                        class="">
                                @else
                                    <svg class="w-full h-full object-cover" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
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
                            <div
                                class="absolute bottom-0 right-0 w-6 h-6 sm:w-8 sm:h-8 bg-green-400 rounded-full border-2 border-white">
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left flex-1">
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                            <p class="text-gray-600 text-lg">{{ $user->email }}</p>
                            <div class="flex flex-wrap justify-center sm:justify-start gap-2 mt-2">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-graduation-cap mr-1"></i>Siswa
                                </span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    <i class="fas fa-star mr-1"></i>IPK 3.75
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0 flex gap-2">
                            <button
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                                <i class="fas fa-edit mr-2"></i>Edit Profile
                            </button>
                            <button
                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                <i class="fas fa-share mr-2"></i>Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Statistik Akademik</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-tasks text-blue-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Tugas Selesai</p>
                                        <p class="text-lg font-semibold text-gray-900">127</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-chart-line text-green-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Nilai Rata Rata</p>
                                        <p class="text-lg font-semibold text-gray-900">94%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-book text-purple-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Kelas Tergabung</p>
                                        <p class="text-lg font-semibold text-gray-900">8</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Info -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Kontak</h2>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-gray-400 w-5"></i>
                                <span class="ml-3 text-gray-700">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-gray-400 w-5"></i>
                                <span class="ml-3 text-gray-700">+62 812-3456-7890</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-gray-400 w-5"></i>
                                <span class="ml-3 text-gray-700">Jakarta, Indonesia</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-gray-400 w-5"></i>
                                <span class="ml-3 text-gray-700">Bergabung
                                    {{ date('d M Y', strtotime('$user->created_at')) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Progress Mata Kuliah -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Progress Kelas</h2>
                            <span class="text-sm text-gray-500">Semester ini</span>
                        </div>
                        <div class="space-y-4">
                            <div class="border border-gray-100 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-medium text-gray-900">Algoritma dan Struktur Data</h3>
                                    <span class="text-sm font-medium text-indigo-600">85%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full progress-bar" style="width: 85%"></div>
                                </div>
                                <div class="flex items-center justify-between mt-2 text-sm text-gray-600">
                                    <span>8/10 Tugas</span>
                                    <span>Grade: A-</span>
                                </div>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-medium text-gray-900">Basis Data</h3>
                                    <span class="text-sm font-medium text-green-600">92%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full progress-bar" style="width: 92%"></div>
                                </div>
                                <div class="flex items-center justify-between mt-2 text-sm text-gray-600">
                                    <span>7/7 Tugas</span>
                                    <span>Grade: A</span>
                                </div>
                            </div>
                            <div class="border border-gray-100 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-medium text-gray-900">Pemrograman Web</h3>
                                    <span class="text-sm font-medium text-yellow-600">78%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-600 h-2 rounded-full progress-bar" style="width: 78%"></div>
                                </div>
                                <div class="flex items-center justify-between mt-2 text-sm text-gray-600">
                                    <span>5/8 Tugas</span>
                                    <span>Grade: B+</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tugas Terbaru -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Tugas Terbaru</h2>
                            <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Lihat
                                Semua</a>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 border border-gray-100 rounded-xl card-hover">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-exclamation text-red-600"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-medium text-gray-900">Implementasi Binary Search Tree</h3>
                                    <p class="text-sm text-gray-600">Algoritma dan Struktur Data</p>
                                    <div class="flex items-center mt-1">
                                        <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full">Deadline: 2
                                            hari</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-medium text-gray-900">Belum Dikerjakan</span>
                                </div>
                            </div>
                            <div class="flex items-center p-4 border border-gray-100 rounded-xl card-hover">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-600"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-medium text-gray-900">Design Database E-Commerce</h3>
                                    <p class="text-sm text-gray-600">Basis Data</p>
                                    <div class="flex items-center mt-1">
                                        <span
                                            class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">Deadline:
                                            5
                                            hari</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-medium text-gray-900">Dalam Progress</span>
                                </div>
                            </div>
                            <div class="flex items-center p-4 border border-gray-100 rounded-xl card-hover">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-medium text-gray-900">Portfolio Website</h3>
                                    <p class="text-sm text-gray-600">Pemrograman Web</p>
                                    <div class="flex items-center mt-1">
                                        <span
                                            class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">Selesai</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-medium text-green-600">95/100</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Achievement -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Pencapaian Terbaru</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div
                                class="flex items-center p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-xl border border-yellow-200">
                                <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-trophy text-white"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-medium text-gray-900">Perfect Attendance</h3>
                                    <p class="text-sm text-gray-600">Hadir semua kelas bulan ini</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                                <div class="w-12 h-12 bg-blue-400 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-medal text-white"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-medium text-gray-900">Top Performer</h3>
                                    <p class="text-sm text-gray-600">Nilai tertinggi di kelas ASD</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Animate progress bars when page loads
            document.addEventListener('DOMContentLoaded', function() {
                const progressBars = document.querySelectorAll('.progress-bar');
                progressBars.forEach(bar => {
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 500);
                });
            });

            // Add hover effects and interactions
            document.querySelectorAll('.card-hover').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        </script>
    @endpush
@endsection
