@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto mt-6 px-4 flex flex-wrap">
        <h2 class="font-bold mb-4 w-full text-center text-3xl">Feedback dari Pengguna</h2>

        @forelse ($feedbacks as $feedback)
            <div class="w-full bg-white shadow-md rounded-lg p-4 mb-4 border min-h-[140px] flex flex-col justify-between">
                <div class="flex items-start">
                    <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                        @if ($feedback->user && $feedback->user->avatar)
                            <img src="{{ $feedback->user->avatar }}" alt="Avatar"
                                class="w-full h-full object-cover object-center">
                        @else
                            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
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

                    <div class="ml-4 flex-1">
                        <p class="text-lg font-semibold">{{ $feedback->user->name }}</p>
                        @if ($feedback->user->email)
                            <p class="text-sm text-gray-500">{{ $feedback->user->email }}</p>
                        @endif
                        <p class="text-xs text-gray-400">{{ $feedback->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <p class="text-gray-800 mt-2">{{ $feedback->feedback }}</p>
            </div>
        @empty
            <p class="text-gray-600 text-center">Belum ada feedback yang dikirim.</p>
        @endforelse
        <div class="mt-4 w-full">
            {{ $feedbacks->links() }}
        </div>

    </div>
@endsection
