@extends('layouts.main')

@section('content')
    <section class="relative w-full h-screen overflow-hidden hero-section bg-cover bg-center" style="background-image: url({{ asset('images/background/heroBG.jpg') }});">
        {{-- <img class="w-full absolute -z-10" src="{{ asset('images/background/heroBG.jpg') }}" alt=""> --}}
        <div class="absolute right-0 w-3/5 h-full bg-gradient-to-l from-[#9D38C2] to-transparent z-0"></div>

        <div class="absolute right-0 w-1/2 h-full flex flex-col justify-center px-25 gap-5">
            <div>
                <h1 class="itim-regular text-7xl text-white">Bebaskan <span class="text-orange-400">Tentor</span></h1>
                <h1 class="itim-regular text-7xl text-white">Mudahkan <span class="text-orange-400">Siswa</span></h1>
            </div>
            <p class="itim-regular text-5xl text-white">Manajemen tugas online yang cerdas dan efisien.</p>
            <button class="hero-button">
                <span class="text-white text-xl itim-regular">Mulai Sekarang</span>
                <div class="star-1">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                        viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs></defs>
                        <g id="Layer_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <path class="fil0"
                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                            </path>
                        </g>
                    </svg>
                </div>
                <div class="star-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                        viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs></defs>
                        <g id="Layer_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <path class="fil0"
                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                            </path>
                        </g>
                    </svg>
                </div>
                <div class="star-3">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                        viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs></defs>
                        <g id="Layer_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <path class="fil0"
                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                            </path>
                        </g>
                    </svg>
                </div>
                <div class="star-4">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                        viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs></defs>
                        <g id="Layer_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <path class="fil0"
                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                            </path>
                        </g>
                    </svg>
                </div>
                <div class="star-5">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                        viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs></defs>
                        <g id="Layer_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <path class="fil0"
                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                            </path>
                        </g>
                    </svg>
                </div>
                <div class="star-6">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                        viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs></defs>
                        <g id="Layer_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <path class="fil0"
                                d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                            </path>
                        </g>
                    </svg>
                </div>
            </button>
        </div>
    </section>

    <section class="w-full px-80 py-20">
        <div class="text-center">
            <h1 class="text-3xl ">Kenapa Harus EduTask?</h1>
            <p class="text-lg">EduTask hadir untuk mempermudah proses belajar-mengajar. Dengan fitur lengkap mulai dari manajemen tugas, pengumpulan otomatis, hingga pemberian nilai dan umpan balik — semua dilakukan dalam satu platform yang rapi dan mudah digunakan.</p>
        </div>
        <div class="card-container flex justify-center items-center mt-10">
            <div class="relative cursor-pointer flex justify-center items-center w-[300px] h-[400px] bg-orange-400/0 card overflow-hidden rounded-2xl hover:bg-orange-400 hover:p-1 transition-all duration-500" style="--r:-15;">
                <div class="h-full w-full bg-orange-400/50 relative z-10 rounded-2xl card-content hover:bg-orange-400 p-5 flex flex-col justify-end">
                    <div class="w-full h-1/2 flex items-center justify-center card-content-top  flex-1">
                        <svg class="w-40" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:#ffffff;}.cls-2{fill:none;}</style></defs><title>center--circle</title><path class="cls-1" d="M30,15H27.9492A12.0071,12.0071,0,0,0,17,4.0508V2H15V4.0508A12.0071,12.0071,0,0,0,4.0508,15H2v2H4.0508A12.0071,12.0071,0,0,0,15,27.9492V30h2V27.9492A12.0071,12.0071,0,0,0,27.9492,17H30ZM17,25.9492V22H15v3.9492A10.0166,10.0166,0,0,1,6.0508,17H10V15H6.0508A10.0166,10.0166,0,0,1,15,6.0508V10h2V6.0508A10.0166,10.0166,0,0,1,25.9492,15H22v2h3.9492A10.0166,10.0166,0,0,1,17,25.9492Z"></path><rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-2" width="32" height="32"></rect></g></svg>
                    </div>
                    <div class="w-full overflow-hidden card-content-bot py-2">
                        <h1 class="text-3xl text-center text-white">Terpusat</h1>
                        <p class="text-center text-lg text-white">Tugas, materi, dan nilai dalam satu platform.</p>
                    </div>
                </div>
            </div>
            <div class="relative cursor-pointer flex justify-center items-center w-[300px] h-[400px] bg-orange-400/0 card overflow-hidden rounded-2xl hover:bg-orange-400 hover:p-1 transition-all duration-500" style="--r:5;">
                <div class="h-full w-full bg-orange-400/50 relative z-10 rounded-2xl card-content hover:bg-orange-400 p-5 flex flex-col justify-end">
                    <div class="w-full h-1/2 flex items-center justify-center card-content-top  flex-1">
                        <svg class="w-40" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M511.996,242.898V0h-242.89v46.266h-26.211V0H0.004v242.898h46.264v26.215H0.004V512h242.89v-46.262h26.211 V512h242.89V269.113H465.73v-26.215H511.996z M123.816,46.969c6.809-4.449,15.99-2.23,20.445,4.59 c4.278,6.953,2.211,16.133-4.744,20.426c-2.369,1.625-5.19,2.223-7.85,2.223c-4.887,0-9.774-2.371-12.434-6.816 C114.795,60.434,116.863,51.258,123.816,46.969z M51.881,368.242c-7.4,3.551-16.279,0.301-19.689-7.105 c-3.559-7.402-0.289-16.289,7.111-19.692c2.068-0.879,4.137-1.476,6.217-1.476c5.625,0,10.945,3.254,13.474,8.586 C62.393,355.953,59.283,364.836,51.881,368.242z M58.994,163.453c-2.529,5.332-7.85,8.586-13.474,8.586 c-2.08,0-4.148-0.598-6.217-1.477c-7.4-3.402-10.67-12.289-7.111-19.691c3.41-7.402,12.289-10.66,19.689-7.106 C59.283,147.172,62.393,156.055,58.994,163.453z M144.262,460.453c-4.455,6.805-13.636,9.035-20.445,4.59 c-6.953-4.293-9.022-13.468-4.582-20.426c2.66-4.445,7.547-6.812,12.434-6.812c2.66,0,5.48,0.586,7.85,2.219 C146.473,444.316,148.539,453.5,144.262,460.453z M266.602,287.672c-3.35,1.121-6.873,1.871-10.602,1.871 c-15.098,0-27.717-10.039-31.924-23.766L76.734,253.77l148.728-11.504c5.028-11.148,15.955-18.965,28.818-19.633l78.51-124.988 c0.621-0.992,2.144-0.262,1.758,0.852l-49.441,141.141c2.74,4.855,4.436,10.394,4.436,16.363c0,10.664-5.072,20.055-12.83,26.195 l77.902,141.082L266.602,287.672z M389.699,462.898c-6.81,4.438-15.99,2.516-20.443-4.297c-4.44-6.805-2.514-15.988,4.295-20.422 c2.516-1.637,5.336-2.52,8.154-2.52c4.726,0,9.471,2.371,12.289,6.809C398.576,449.277,396.652,458.461,389.699,462.898z M393.994,69.539c-2.818,4.437-7.562,6.808-12.289,6.808c-2.818,0-5.639-0.89-8.154-2.516c-6.808-4.445-8.734-13.617-4.295-20.426 c4.453-6.809,13.633-8.742,20.443-4.297C396.652,53.551,398.576,62.73,393.994,69.539z M466.524,335.711 c2.082,0,4.15,0.446,6.074,1.328c7.402,3.262,10.813,12,7.402,19.543c0,0.144-0.144,0.453-0.289,0.742c0,0-0.144,0.148-0.144,0.301 c-3.27,7.547-12.144,10.797-19.547,7.547c-7.404-3.402-10.814-12.145-7.404-19.692c0-0.144,0.145-0.297,0.289-0.59 c0-0.145,0-0.301,0.158-0.301C455.422,338.965,460.898,335.711,466.524,335.711z M453.062,167.422 c-0.158,0-0.158-0.152-0.158-0.297c-0.144-0.301-0.289-0.45-0.289-0.594c-3.41-7.555,0-16.289,7.404-19.695 c7.402-3.258,16.277,0,19.547,7.551c0,0.148,0.144,0.293,0.144,0.293c0.145,0.301,0.289,0.598,0.289,0.746 c3.41,7.551,0,16.289-7.402,19.543c-1.924,0.887-3.992,1.328-6.074,1.328C460.898,176.297,455.422,173.043,453.062,167.422z"></path> </g> </g></svg>
                    </div>
                    <div class="w-full overflow-hidden card-content-bot py-2">
                        <h1 class="text-3xl text-center text-white">Efisien</h1>
                        <p class="text-center text-lg text-white">Tentor lebih mudah kelola tugas dan nilai.</p>
                    </div>
                </div>
            </div>
            <div class="relativ cursor-pointer flex justify-center items-center w-[300px] h-[400px] bg-orange-400/0 card overflow-hidden rounded-2xl hover:bg-orange-400 hover:p-1 transition-all duration-500" style="--r:25;">
                <div class="h-full w-full bg-orange-400/50 relative z-10 rounded-2xl card-content hover:bg-orange-400 p-5 flex flex-col justify-end">
                    <div class="w-full h-1/2 flex items-center justify-center card-content-top  flex-1">
                        <svg class="w-40" viewBox="0 0 48 48" enable-background="new 0 0 48 48" id="Layer_3" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M46.25,0H2.875H0v8v32h20v8h20v-8h8V8V0H46.25z M36,3c1.104,0,2,0.896,2,2s-0.896,2-2,2s-2-0.896-2-2 S34.896,3,36,3z M6,3h24c1.104,0,2,0.896,2,2s-0.896,2-2,2H6C4.896,7,4,6.104,4,5S4.896,3,6,3z M30,46.594c-1.104,0-2-0.896-2-2 s0.896-2,2-2s2,0.896,2,2S31.104,46.594,30,46.594z M36,40.969H24V40v-4V18.083h12V36v4V40.969z M44,36h-4V14.083H20V36H4V10h40V36z M42,7c-1.104,0-2-0.896-2-2s0.896-2,2-2s2,0.896,2,2S43.104,7,42,7z" fill="#ffffff"></path></g></svg>
                    </div>
                    <div class="w-full overflow-hidden card-content-bot py-2">
                        <h1 class="text-3xl text-center text-white">Fleksibel</h1>
                        <p class="text-center text-lg text-white">Akses kapan saja, di mana saja secara online.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full h-fit flex flex-col items-center justify-center">
        <h1 class="text-3xl mt-10">Solusi Tepat Untuk</h1>
        <div class="w-full h-full flex justify-center items-center gap-40">
            <div class=" h-full text-center w-[500px]">
                <div>
                    <h1 class="text-3xl text-[#9D38C2]">SISWA</h1>
                    <p class="text-xl text-[#535353]">Pelajar yang pakai Edutask untuk akses tugas & lihat progres belajar lebih teratur.</p>
                </div>
                <div class="text-left text-xl mt-10">
                    <p>1. Buat Tugas: "Lengkapi detail tugas, lampirkan file pendukung, dan tentukan batas waktu pengumpulan."</p>
                    <p>2. Distribusikan ke Siswa: "Pilih kelas atau siswa yang dituju, tugas langsung terkirim."</p>
                    <p>3. Pantau & Beri Nilai: "Lihat status pengumpulan, periksa hasil tugas, dan berikan penilaian langsung."</p>
                </div>
            </div>
            <div class="">
                <img class="w-[500px]" src="{{ asset('images/background/tentor.png') }}" alt="">
            </div>
        </div>
        <div class="w-full h-full flex justify-center items-center gap-40">
            <div class="">
                <img class="w-[500px]" src="{{ asset('images/background/siswa.png') }}" alt="">
            </div>
            <div class=" h-full text-center w-[500px]">
                <div>
                    <h1 class="text-3xl text-[#9D38C2]">TENTOR</h1>
                    <p class="text-xl text-[#535353]">Pengajar yang memakai Edutask untuk kelola tugas & pantau progres siswa online.</p>
                </div>
                <div class="text-left text-xl mt-10">
                    <p>1. Cek Daftar Tugas: "Lihat semua tugas yang diberikan tentormu beserta tenggat waktunya."</p>
                    <p>2. Kerjakan & Unggah: "Selesaikan tugasmu lalu unggah file jawabanmu dengan mudah ke Edutask."</p>
                    <p>3. Lihat Hasil & Status: "Pantau status pengumpulanmu dan lihat nilai serta feedback dari tentor."</p>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full relative bg-[linear-gradient(85deg,#f87216_0%,#8e2db4_100%)] py-20 mt-10 ">
        <div class="w-full testimonial">
            <div class="w-full px-40">
                <div class="w-full flex flex-col items-center text-white ">
                    <h1 class="text-center text-3xl">Apa kata Yang Lain?</h1>
                    <p class="text-center text-lg w-96 text-gray-100">Lebih dari Sekadar Kata-kata: Ini Pengalaman Berharga Mereka dengan Edutask.</p>
                </div>
                <div class="w-full relative mt-10">
                    <div class="w-full flex relative p-5 overflow-x-scroll custom-scroll overflow-y-hidden gap-10" style="scrollbar-width: 0">
                        @for($i = 0; $i < 5; $i++)
                        <div class="w-[500px] h-[300px] flex flex-col flex-shrink-0 bg-white rounded-2xl p-8">
                            <div class="flex items-center gap-5">
                                <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-gray-200 hover:scale-105 transition-transform bg-white">
                                    <img class="w-full h-full object-cover" src="{{ asset('images/avatars/yuna.jpg') }}" alt="Yuna's avatar">
                                </div>
                                <div class="">
                                    <h1 class="text-xl">Brili Pacar yuna</h1>
                                    <h1 class="text-gray-700">brilipacaryuna@gmail.com</h1>
                                </div>
                            </div>
                            <div class="mt-5 w-full flex-1 overflow-y-scroll comment-scroll">
                                <p class="text-xl">Wahhhh keren bangettt webnya, memudahkan pengerjaan tugasku dan melihat materinyaaaaaaa!!! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt optio quidem doloremque voluptatem, modi quibusdam sit nulla eius. Laborum illum ratione eaque amet earum unde rem reprehenderit provident. Molestiae, ducimus!</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
