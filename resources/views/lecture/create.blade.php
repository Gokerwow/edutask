@extends('layouts.main')

@section('content')
    <div class="bg-white p-8 sm:p-12 rounded-xl shadow-xl w-full max-w-2xl place-self-center my-10">
        <header class="mb-10 text-center">
            <div class="inline-block p-3.5 rounded-full bg-orange-500 text-white mb-5 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-9 h-9">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800">Buat Kelas Baru</h1>
            <p class="text-gray-500 mt-3 text-md">Isi formulir di bawah ini untuk memulai kelas Edutask-mu.</p>
        </header>

        <form action="{{ route('lecture.store') }}" method="POST" class="space-y-7" id="createClassForm" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="class-name" class="form-label-orange-theme">Nama Kelas</label>
                <input type="text" name="class-name" id="class-name" class="form-input-orange-theme"
                    placeholder="Contoh: Workshop Desain Grafis Esensial" required>
            </div>

            <div>
                <label for="class-topic" class="form-label-orange-theme">Topik Utama / Mata Pelajaran</label>
                <input type="text" name="class-topic" id="class-topic" class="form-input-orange-theme"
                    placeholder="Contoh: Desain Grafis">
            </div>

            <div>
                <label for="class-description" class="form-label-orange-theme">Deskripsi Kelas</label>
                <textarea name="class-description" id="class-description" rows="4" class="form-input-orange-theme"
                    placeholder="Berikan gambaran singkat mengenai apa yang akan dipelajari di kelas ini..."></textarea>
            </div>

            <div>
                <label for="class-code" class="form-label-orange-theme">Kode Kelas</label>
                <div class="mt-1.5 flex">
                    <input type="text" name="class-code" id="class-code" class="form-input-generated flex-grow"
                        placeholder="Klik 'Generate' untuk kode" readonly>
                    <button type="button" id="generateCodeBtn" class="btn-generate-orange">
                        <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Generate
                    </button>
                </div>
                <p class="mt-1.5 text-xs text-gray-500">Kode unik akan dibuat otomatis untuk kelas Anda.</p>
            </div>


            <div>
                <label class="form-label-orange-theme">Gambar Sampul Kelas (Opsional)</label>
                <div class="mt-1.5 flex items-center justify-center w-full">
                    <label for="cover-upload"
                        class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-orange-400 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-orange-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk unggah</span> atau
                                seret file</p>
                            <p class="text-xs text-gray-400">SVG, PNG, JPG atau GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="cover-upload" type="file" class="hidden" name="class-banner" />
                    </label>
                </div>
            </div>


            <div class="pt-8 space-y-4">
                <button type="submit" class="btn-primary-orange">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 mr-2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Buat Kelas
                </button>
                <button type="button" class="btn-secondary-orange">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 mr-2.5 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
            </div>
        </form>
        <p class="text-center text-xs text-gray-400 mt-10">
            Butuh bantuan? <a href="#" class="font-medium text-orange-500 hover:text-orange-600">Hubungi
                Dukungan</a>.
        </p>
    </div>

    @push('scripts')
        @vite('resources/js/codeBTN.js')
    @endpush

@endsection
