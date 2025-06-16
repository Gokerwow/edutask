// Ambil elemen-elemen DOM yang diperlukan
const coverUploadInput = document.getElementById('cover-upload');
const uploadPrompt = document.getElementById('upload-prompt');
const imagePreviewContainer = document.getElementById('image-preview-container');
const imagePreview = document.getElementById('image-preview');
const removeImageBtn = document.getElementById('remove-image-btn');

// Fungsi untuk menampilkan pratinjau gambar
const showPreview = (file) => {
    const reader = new FileReader();
    reader.onload = function(e) {
        imagePreview.src = e.target.result;
        uploadPrompt.classList.add('hidden');
        imagePreviewContainer.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
};

// Fungsi untuk menyembunyikan pratinjau dan kembali ke tampilan awal
const hidePreview = () => {
    // Reset nilai input file agar bisa memilih file yang sama lagi
    coverUploadInput.value = '';
    imagePreview.src = '#';
    uploadPrompt.classList.remove('hidden');
    imagePreviewContainer.classList.add('hidden');
};

// Tambahkan event listener saat file dipilih
coverUploadInput.addEventListener('change', function(event) {
    const files = event.target.files;
    if (files && files[0]) {
        showPreview(files[0]);
    }
});

// Tambahkan event listener untuk tombol hapus
removeImageBtn.addEventListener('click', function(event) {
    // Mencegah event click menyebar ke label, yang akan memicu pemilihan file
    event.stopPropagation();
    event.preventDefault();
    hidePreview();
});
