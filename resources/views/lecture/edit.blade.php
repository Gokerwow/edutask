{{-- resources/views/lecture/edit.blade.php --}}

@extends('layouts.main')

@section('content')
    <div class="bg-white p-8 sm:p-12 rounded-xl shadow-xl w-full max-w-2xl place-self-center my-10">
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-gray-800">Edit Kelas</h1>
            <p class="text-gray-500 mt-3 text-md">Perbarui detail kelas Anda di bawah ini.</p>
        </header>

        <form action="{{ route('lecture.update', $lecture->id) }}" method="POST" class="space-y-7"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="class-name" class="form-label-orange-theme">Nama Kelas</label>
                <input type="text" name="class-name" id="class-name" class="form-input-orange-theme"
                    value="{{ old('class-name', $lecture->name) }}" required>
            </div>

            <div>
                <label for="class-topic" class="form-label-orange-theme">Topik Utama / Mata Pelajaran</label>
                <input type="text" name="class-topic" id="class-topic" class="form-input-orange-theme"
                    value="{{ old('class-topic', $lecture->topic) }}">
            </div>

            <div>
                <label for="class-description" class="form-label-orange-theme">Deskripsi Kelas</label>
                <textarea name="class-description" id="class-description" rows="4" class="form-input-orange-theme">{{ old('class-description', $lecture->description) }}</textarea>
            </div>

            <div>
                <label for="class-code" class="form-label-orange-theme">Kode Kelas</label>
                <div class="mt-1.5 flex">
                    <input type="text" name="class-code" id="class-code" class="form-input-generated flex-grow"
                        value="{{ $lecture->code }}" readonly>
                </div>
                <p class="mt-1.5 text-xs text-gray-500">Kode kelas tidak dapat diubah.</p>
            </div>

            <div>
                <label class="form-label-orange-theme">Gambar Sampul Kelas (Opsional)</label>
                <div class="mt-1.5 w-full">
                    <label id="cover-upload-label" for="cover-upload"
                        class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div id="upload-prompt" class="flex flex-col items-center justify-center text-center p-4">
                            <svg class="w-10 h-10 mb-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk unggah</span> atau
                                seret file</p>
                            <p class="text-xs text-gray-400">SVG, PNG, JPG atau GIF (MAX. 2MB)</p>
                        </div>

                        {{-- Tampilan Pratinjau (Jika sudah ada banner) --}}
                        <div id="image-preview-container"
                            class="{{ $lecture->banner ? '' : 'hidden' }} absolute inset-0 w-full h-full">
                            <img id="image-preview" src="{{ $lecture->banner ? asset($lecture->banner) : '#' }}"
                                alt="Pratinjau Sampul" class="w-full h-full object-cover rounded-lg">
                            <button type="button" id="remove-image-btn"
                                class="absolute top-2 right-2 bg-white/70 backdrop-blur-sm text-red-500 rounded-full p-1.5 shadow-md hover:bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.134-2.036-2.134H8.716C7.59 2.75 6.68 3.704 6.68 4.884v.916m7.5 0h-7.5" />
                                </svg>
                            </button>
                        </div>
                        <input id="cover-upload" type="file" class="hidden" name="class-banner"
                            accept="image/png, image/jpeg, image/gif, image/svg+xml" />
                    </label>
                </div>
            </div>

            <div class="pt-8 space-y-4">
                <button type="submit" class="btn-primary-orange">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 mr-2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('lecture.show', $lecture->id) }}" class="btn-secondary-orange">
                    Batal
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        @vite('resources/js/image-preview.js')
    @endpush
@endsection
