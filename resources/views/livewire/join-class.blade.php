<x-modal name="join-class" maxWidth="md">
    <div id="joinClassPopup"
        class="fixed z-20 inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex justify-center items-center"
        style="display: flex;">
        <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg">
            <button onclick="document.getElementById('joinClassPopup').style.display='none'"
                class="absolute top-0 right-0 mt-4 mr-4 text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-center">
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Gabung Kelas</h3>
                <p class="text-sm text-gray-500 mb-6">Masukkan kode kelas yang Anda dapatkan dari pengajar.</p>
            </div>

            <form action="#" method="POST">
                <div>
                    <label for="class_code" class="block text-sm font-medium text-gray-700 mb-1">Kode Kelas</label>
                    <input type="text" name="class_code" id="class_code"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: XYZ123" required>
                </div>

                <div class="mt-8">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Gabung
                    </button>
                </div>
                <div class="mt-4 text-center">
                    <button type="button" onclick="document.getElementById('joinClassPopup').style.display='none'"
                        class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-modal>
