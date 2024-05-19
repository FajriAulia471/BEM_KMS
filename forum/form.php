<div id="komentar-form" class="">
    <form class="max-w-full mx-auto" action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" value="<?php echo $data['id_topik']; ?>" name="id_topik">
        <input type="hidden" name="form_type" value="komentar">
        <div class="w-full mb-2 rounded-xl bg-gray-50">
            <label for="file_input" class="block text-sm font-medium font-body text-header">Upload Foto :</label>
            <input
                class="block w-full text-md font-body text-secondary border border-gray-300 rounded-full cursor-pointer bg-gray-50 focus:ring-2 focus:ring-secondary focus:border-secondary"
                aria-describedby="file_input_help" id="file_input" name="foto" type="file">
            <p class="mt-1 text-sm font-body text-secondary" id="file_input_help">PNG, JPG, JPEG</p>
        </div>
        <label for="komentar" class="block text-sm font-medium font-body text-header mt-1">Balas Komentar :</label>
        <div class="w-full mb-2 border border-gray-300 rounded-xl bg-gray-50">
            <div class="px-4 py-2 bg-white rounded-t-xl ">
                <textarea id="komentar" rows="4" name="komentar"
                    class="w-full px-0 text-lg font-body text-header bg-white border-0 focus:ring-0"
                    placeholder="Tulis Komentar..." required></textarea>
            </div>
            <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                <button type="submit" name="submit" value="submit" style="background-color: #291334;"
                    class=" p-3 ms-2 text-sm font-medium text-white  rounded-full border transition-all duration-300 ease-in-out transform active:scale-90 font-body">Submit
                    Komentar</button>
            </div>
        </div>
    </form>
</div>

<div id="reply-form" class="hidden">
    <form class="max-w-full mx-auto" action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" value="<?php echo $data['id_topik']; ?>" name="id_topik">
        <input type="hidden" name="form_type" value="reply">
        <div class="relative mb-2 flex">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-at-symbol h-5 w-5 text-secondary">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2"
                        d="M16 20.064A9 9 0 1121 12v1.5a2.5 2.5 0 01-5 0V8m0 4a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <input type="text" id="nama" name="nama"
                class="block p-2 ps-10 text-sm text-body text-header border-0 bg-primary" readonly disabled>
            <input type="hidden" name="id_komentar" id="id_komentar">
            <button type="button" id="clear-button"
                class="text-white font-medium font-body rounded-full text-sm px-3 py-1 ml-2 transition-all duration-300 ease-in-out transform active:scale-90"
                style="background-color: #FF5861;">Hapus</button>
        </div>
        <div class="w-full mb-2 rounded-xl bg-gray-50">
            <label for="file_input" class="block text-sm font-medium font-body text-header">Upload Foto :</label>
            <input
                class="block w-full text-md font-body text-secondary border border-gray-300 rounded-full cursor-pointer bg-gray-50 focus:ring-2 focus:ring-secondary focus:border-secondary"
                aria-describedby="file_input_help" id="file_input" name="foto" type="file">
            <p class="mt-1 text-sm font-body text-secondary" id="file_input_help">PNG, JPG, JPEG</p>
        </div>

        <label for="reply" class="block text-sm font-medium font-body text-header mt-1">Balas Komentar :</label>
        <div class="w-full mb-2 border border-gray-300 rounded-xl bg-gray-50">
            <div class="px-4 py-2 bg-white rounded-t-xl ">
                <textarea id="reply" rows="4" name="reply"
                    class="w-full px-0 text-lg font-body text-header bg-white border-0 focus:ring-0"
                    placeholder="Tulis Komentar..." required></textarea>
            </div>
            <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                <button type="submit" name="submit" value="submit" style="background-color: #291334;"
                    class=" p-3 ms-2 text-sm font-medium text-white  rounded-full border transition-all duration-300 ease-in-out transform active:scale-90 font-body">Submit
                    Komentar</button>
            </div>
        </div>
    </form>
</div>

<div id="replyReply-form" class="hidden">
    <form class="max-w-full mx-auto" action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" value="<?php echo $data['id_topik']; ?>" name="id_topik">
        <input type="hidden" name="form_type" value="reply-reply">
        <div class="relative mb-2 flex">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-at-symbol h-5 w-5 text-secondary">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2"
                        d="M16 20.064A9 9 0 1121 12v1.5a2.5 2.5 0 01-5 0V8m0 4a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <input type="text" id="namaa" name="namaa"
                class="block p-2 ps-10 text-sm text-body text-header border-0 bg-primary" readonly disabled>
            <input type="hidden" name="parent_id_reply" id="parent_id_reply">
            <!-- <input type="text" id="parent_id_reply" name="parent_id_reply"
                class="block p-2 ps-10 text-sm text-body text-header border-0 bg-primary" readonly disabled> -->
            <button type="button" id="clear-reply-button"
                class="text-white font-medium font-body rounded-full text-sm px-3 py-1 ml-2 transition-all duration-300 ease-in-out transform active:scale-90"
                style="background-color: #FF5861;">Hapus</button>
        </div>
        <div class="w-full mb-2 rounded-xl bg-gray-50">
            <label for="file_input" class="block text-sm font-medium font-body text-header">Upload Foto :</label>
            <input
                class="block w-full text-md font-body text-secondary border border-gray-300 rounded-full cursor-pointer bg-gray-50 focus:ring-2 focus:ring-secondary focus:border-secondary"
                aria-describedby="file_input_help" id="file_input" name="foto" type="file">
            <p class="mt-1 text-sm font-body text-secondary" id="file_input_help">PNG, JPG, JPEG</p>
        </div>

        <label for="reply" class="block text-sm font-medium font-body text-header mt-1">Balas Komentar :</label>
        <div class="w-full mb-2 border border-gray-300 rounded-xl bg-gray-50">
            <div class="px-4 py-2 bg-white rounded-t-xl ">
                <textarea id="reply" rows="4" name="reply"
                    class="w-full px-0 text-lg font-body text-header bg-white border-0 focus:ring-0"
                    placeholder="Tulis Komentar..." required></textarea>
            </div>
            <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                <button type="submit" name="submit" value="submit" style="background-color: #291334;"
                    class=" p-3 ms-2 text-sm font-medium text-white  rounded-full border transition-all duration-300 ease-in-out transform active:scale-90 font-body">Submit
                    Komentar</button>
            </div>
        </div>
    </form>
</div>