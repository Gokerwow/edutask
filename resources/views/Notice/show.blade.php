@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <a href="{{ route('lecture.show', $lecture) }}"
            class="inline-flex items-center text-gray-600 hover:text-gray-800 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Kelas
        </a>

        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $notice->description }}</h1>
                    @if ($notice->lecture->user->first()->id == Auth::id())
                        <a href="{{ route('notice.edit', [$lecture, $notice]) }}"
                            class="px-3 py-1 bg-blue-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors">
                            Edit
                        </a>
                    @endif
                </div>
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    @if ($notice->user && $notice->user->avatar)
                        <img class="h-8 w-8 rounded-full object-cover mr-3" src="{{ $notice->user->avatar }}"
                            alt="Avatar">
                    @else
                        <svg class="w-8 h-8 rounded-full overflow-hidden mr-3" viewBox="0 0 100 100"
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

                    <span>Dibuat oleh <span class="font-medium">{{ $notice->lecture->user->first()->name }}</span> &bull;
                        {{ $notice->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Beri Komentar</h2>
            <form action="{{ route('notice.comment.store', [$lecture, $notice]) }}" method="POST">
                @csrf
                <textarea name="comment_body" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md"
                    placeholder="Tulis komentar Anda..." required></textarea>
                <div class="text-right mt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Kirim</button>
                </div>
            </form>
        </div>

        <div class="space-y-6">
            <h2 class="text-xl font-semibold">{{ $notice->comments->count() }} Komentar</h2>
            @forelse ($notice->comments as $comment)
                <div class="flex items-start">
                    @if ($comment->user && $comment->user->avatar)
                        <img class="h-10 w-10 rounded-full object-cover mr-4" src="{{ $comment->user->avatar }}"
                            alt="Avatar">
                    @else
                        <svg class="w-10 h-10 rounded-full overflow-hidden mr-4" viewBox="0 0 100 100"
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

                    <div class="flex-1 bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-800">{{ $comment->user->name }}</span>
                            {{-- Tombol aksi dan timestamp --}}
                            <div class="flex items-center gap-3 text-xs">
                                {{-- Tampilkan tombol hanya jika user adalah pemilik komentar --}}
                                @if (Auth::id() == $comment->user_id)
                                    <form action="{{ route('comment.destroy', [$lecture, $notice, $comment]) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus komentar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:text-red-800">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                                <span class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="text-gray-700 mt-2">{{ $comment->comment }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">Belum ada komentar.</p>
            @endforelse
        </div>
    </div>
@endsection
