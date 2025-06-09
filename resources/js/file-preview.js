const fileUpload = document.getElementById("file-upload");
const previewDiv = document.getElementById("previewDiv");
const textPreview = document.getElementById("textPreview");

fileUpload.addEventListener("change", updateFilePreview);

// SOLUSI: Pasang event listener pada 'previewDiv'
previewDiv.addEventListener("click", function (event) {
    // Gunakan .closest() untuk memeriksa apakah elemen yang diklik,
    // atau salah satu induknya, adalah elemen #deleteFilePreview
    const deleteButton = event.target.closest("#deleteFilePreview");

    if (deleteButton) {
        // Jika deleteButton ditemukan (artinya kita mengklik ikon X)
        console.log("Tombol hapus preview diklik");

        fileUpload.value = ""; // Kosongkan nilai input file
        previewDiv.innerHTML = ""; // Kosongkan konten div preview
        textPreview.classList.add("hidden"); // Tampilkan kembali preview teks
    }
});
function updateFilePreview() {
    console.log("File upload changed");

    if (fileUpload.files.length > 0) {
        let fileNameValue = fileUpload.files[0].name;
        let fileSize = fileUpload.files[0].size;
        fileSize = formatBytes(fileSize); // Format ukuran file
        const filePreviewHtml = `                             <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="border rounded-lg p-3 flex items-center">
                                    <!-- SVG PDF Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-gray-800">${fileNameValue}</p>
                                        <p class="text-sm text-gray-500">${fileSize}</p>
                                    </div>
                                    <button type="button" id="deleteFilePreview" class="text-orange-600 hover:text-orange-700 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>`;
        previewDiv.innerHTML = filePreviewHtml;
        textPreview.classList.remove("hidden"); // Sembunyikan preview teks jika ada file yang diunggah
    } else {
        console.log("No file selected");
        previewDiv.innerHTML = "";
    }
}

// Fungsi helper untuk memformat bytes menjadi KB, MB, GB, dll.
function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return "0 Bytes";

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ["Bytes", "KB", "MB", "GB", "TB"];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
}
