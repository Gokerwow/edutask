// Tangkap semua form dengan class 'delete-form'
const deleteForms = document.querySelectorAll(".delete-form");

deleteForms.forEach((form) => {
    form.addEventListener("submit", function (event) {
        // Hentikan pengiriman form default
        event.preventDefault();

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda tidak akan dapat melihat infomrasi tentang kelas ini lagi!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            // Jika pengguna menekan tombol "Ya, hapus!"
            if (result.isConfirmed) {
                // Lanjutkan pengiriman form
                form.submit();
            }
        });
    });
});
