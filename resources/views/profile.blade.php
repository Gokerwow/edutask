@extends('layouts.main')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <x-sidebar :user="$user" class="lg:w-1/4" />

            <!-- Main Content -->
            <div class="lg:w-3/4 space-y-8">
                <!-- Profile Header -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <div class="gradient-bg h-32 sm:h-40 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-orange-500 opacity-90"></div>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 sm:-mt-20">
                            <div class="relative group">
                                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg overflow-hidden transition-transform duration-300 group-hover:scale-105">
                                    @if ($user->avatar)
                                        <img class="w-full h-full object-cover" src="{{ $user->avatar }}" alt="Profile">
                                    @else
                                        <svg class="w-full h-full object-cover" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="circleGradient" x1="100%" y1="0%" x2="0%" y2="100%">
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
                                <div class="absolute bottom-0 right-0 w-6 h-6 sm:w-8 sm:h-8 bg-green-400 rounded-full border-2 border-white shadow-sm"></div>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left flex-1">
                                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                                <p class="text-gray-600 text-lg">{{ $user->email }}</p>
                                <p class="text-sm text-gray-500 mt-1">Member since {{ date('d M Y', strtotime($user->created_at)) }}</p>
                            </div>
                            <div class="mt-4 sm:mt-0 flex gap-2">
                                <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center shadow-sm hover:shadow-md">
                                    <i class="fas fa-edit mr-2"></i>Edit Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Contact Info -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-md">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-address-card text-indigo-500 mr-2"></i>
                                Contact Information
                            </h2>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="bg-indigo-50 p-2 rounded-lg">
                                        <i class="fas fa-user text-indigo-600 w-5"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-500">Name</p>
                                        <p class="text-gray-700 font-medium">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-indigo-50 p-2 rounded-lg">
                                        <i class="fas fa-envelope text-indigo-600 w-5"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="text-gray-700 font-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-indigo-50 p-2 rounded-lg">
                                        <i class="fas fa-calendar-day text-indigo-600 w-5"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-500">Member Since</p>
                                        <p class="text-gray-700 font-medium">{{ date('d M Y', strtotime($user->created_at)) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Classes Section -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                            <div class="border-b border-gray-100 px-6 py-4 bg-gray-50">
                                <h3 class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-chalkboard-teacher text-indigo-500 mr-2"></i>
                                    Your Classes
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="mb-6">
                                    <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                                        <i class="fas fa-user-graduate text-blue-500 mr-2 text-sm"></i>
                                        Classes You're Taking
                                    </h4>
                                    <ul class="space-y-2">
                                        @forelse($kelasDiikuti as $kelas)
                                            <li class="flex items-center py-2 px-3 bg-blue-50 rounded-lg">
                                                <i class="fas fa-bookmark text-blue-400 mr-2 text-sm"></i>
                                                <span>{{ $kelas->name ?? 'Unnamed Class' }}</span>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 text-sm py-2 px-3 bg-gray-50 rounded-lg">
                                                No classes enrolled
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>

                                <div>
                                    <h4 class="font-medium text-gray-700 mb-3 flex items-center">
                                        <i class="fas fa-chalkboard text-purple-500 mr-2 text-sm"></i>
                                        Classes You're Teaching
                                    </h4>
                                    <ul class="space-y-2">
                                        @forelse($kelasDibimbing as $kelas)
                                            <li class="flex items-center py-2 px-3 bg-purple-50 rounded-lg">
                                                <i class="fas fa-bookmark text-purple-400 mr-2 text-sm"></i>
                                                <span>{{ $kelas->name ?? 'Unnamed Class' }}</span>
                                            </li>
                                        @empty
                                            <li class="text-gray-500 text-sm py-2 px-3 bg-gray-50 rounded-lg">
                                                No teaching classes
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Assignments Section -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                            <div class="border-b border-gray-100 px-6 py-4 bg-gray-50">
                                <h3 class="font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-tasks text-indigo-500 mr-2"></i>
                                    Your Assignments
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="mb-8">
                                    <h4 class="font-medium text-gray-700 mb-4 flex items-center border-b pb-2">
                                        <i class="fas fa-user-graduate text-blue-500 mr-2"></i>
                                        Assignments from Your Classes
                                    </h4>
                                    <div class="space-y-4">
                                        @forelse($tugasSiswa as $assignment)
                                            <div class="border-l-4 border-blue-400 pl-4 py-2 hover:bg-blue-50 rounded-r-lg transition-colors duration-200">
                                                <div class="flex justify-between items-start">
                                                    <h5 class="font-medium text-gray-900">{{ $assignment->title }}</h5>
                                                    <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                                        Due: {{ $assignment->deadline->format('d M Y H:i') }}
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <i class="fas fa-chalkboard text-gray-400 mr-1"></i>
                                                    {{ $assignment->lecture->name ?? 'N/A' }}
                                                </p>
                                            </div>
                                        @empty
                                            <div class="text-center py-4 text-gray-500">
                                                <i class="fas fa-inbox text-2xl mb-2 text-gray-300"></i>
                                                <p>No assignments from your classes</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-medium text-gray-700 mb-4 flex items-center border-b pb-2">
                                        <i class="fas fa-chalkboard-teacher text-purple-500 mr-2"></i>
                                        Assignments You're Teaching
                                    </h4>
                                    <div class="space-y-4">
                                        @forelse($tugasTentor as $assignment)
                                            <div class="border-l-4 border-purple-400 pl-4 py-2 hover:bg-purple-50 rounded-r-lg transition-colors duration-200">
                                                <div class="flex justify-between items-start">
                                                    <h5 class="font-medium text-gray-900">{{ $assignment->title }}</h5>
                                                    <span class="text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded-full">
                                                        Due: {{ $assignment->deadline->format('d M Y H:i') }}
                                                    </span>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <i class="fas fa-chalkboard text-gray-400 mr-1"></i>
                                                    {{ $assignment->lecture->name ?? 'N/A' }}
                                                </p>
                                            </div>
                                        @empty
                                            <div class="text-center py-4 text-gray-500">
                                                <i class="fas fa-inbox text-2xl mb-2 text-gray-300"></i>
                                                <p>No teaching assignments</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div id="editProfileModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <i class="fas fa-user-edit text-indigo-500 mr-2"></i>
                            Edit Profile
                        </h3>
                        <button id="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" id="password" name="password" placeholder="Leave blank to keep current"
                                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="cancelEdit" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
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

                // Initialize modal animation
                const modal = document.getElementById('editProfileModal');
                const modalContent = document.getElementById('modalContent');

                // When opening modal
                document.querySelectorAll('[onclick*="editProfileModal"]').forEach(btn => {
                    btn.addEventListener('click', function() {
                        modal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                        setTimeout(() => {
                            modalContent.classList.remove('opacity-0');
                            modalContent.classList.remove('scale-95');
                            modalContent.classList.add('opacity-100');
                            modalContent.classList.add('scale-100');
                        }, 10);
                    });
                });

                // Close modal functions
                function closeModal() {
                    modalContent.classList.add('opacity-0');
                    modalContent.classList.add('scale-95');
                    modalContent.classList.remove('opacity-100');
                    modalContent.classList.remove('scale-100');

                    setTimeout(() => {
                        modal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }, 300);
                }

                document.getElementById('closeModal').addEventListener('click', closeModal);
                document.getElementById('cancelEdit').addEventListener('click', closeModal);

                // Close modal when clicking outside
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModal();
                    }
                });

                // Form submission with feedback
                document.getElementById('profileForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const form = this;
                    const formData = new FormData(form);
                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;

                    // Show loading state
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';

                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message with toast
                            showToast('Profile updated successfully!', 'success');
                            closeModal();
                            // Optionally refresh the page or update the displayed info
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            // Handle validation errors
                            let errorMessage = data.message || 'Please check your inputs';
                            if (data.errors) {
                                errorMessage = Object.values(data.errors).join('<br>');
                            }
                            showToast(errorMessage, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('An error occurred while updating your profile.', 'error');
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                    });
                });

                // Toast notification function
                function showToast(message, type = 'success') {
                    const toast = document.createElement('div');
                    toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${
                        type === 'success' ? 'bg-green-500' : 'bg-red-500'
                    } animate-fade-in-up z-50`;
                    toast.innerHTML = message;
                    document.body.appendChild(toast);

                    setTimeout(() => {
                        toast.classList.remove('animate-fade-in-up');
                        toast.classList.add('animate-fade-out');
                        setTimeout(() => {
                            toast.remove();
                        }, 300);
                    }, 3000);
                }
            });
        </script>
    @endpush

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #7e22ce 0%, #f97316 100%);
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out forwards;
        }

        .animate-fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        .progress-bar {
            transition: width 1s ease-in-out;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            transition: transform 0.3s ease;
        }
    </style>
@endsection
