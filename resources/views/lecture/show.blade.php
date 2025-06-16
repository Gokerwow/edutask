@extends('layouts.main')

@section('content')
    @livewire('class-main', [
        'lecture' => $lecture,
        'tugasTerbaru' => $tugasTerbaru,
        'materiTerbaru' => $materiTerbaru,
        'tugas' => $tugas,
        'materi' => $materi,
        'pengumuman' => $pengumuman,
        'isTentorInThisClass' => $isTentorInThisClass,
        'userCount' => $lecture->user_count,
    ])
    @push('scripts')
        @vite('resources/js/confirmLectureExit.js')
    @endpush
@endsection
