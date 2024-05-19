<div class="mt-5 mb-5 flex justify-start">
    <div class="flex items-start gap-2.5">
        <img class="w-8 h-8 rounded-full" src="../assets/profile/<?php echo ($komentar['anggota_foto']) ?>"
            alt="Jese image">
        <div class="flex flex-col gap-1">
            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                <span
                    class="text-sm font-medium text-header font-body "><?php echo htmlentities($komentar['nama']); ?></span>
            </div>
            <div
                class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-blue-50 rounded-e-xl rounded-es-xl">
                <p class="text-sm font-normal text-header font-body"><?php echo $komentar['komentar'] ?></p>
                <?php if (!empty($komentar['foto'])): ?>
                    <div class="group relative my-2.5">
                        <div
                            class="absolute w-full h-full bg-gray-900/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                            <a href="../assets/forum/<?php echo $komentar['foto'] ?>" download>
                                <button
                                    class="inline-flex items-center justify-center rounded-full h-10 w-10 bg-white/30 hover:bg-white/50 focus:ring-4 focus:outline-none focus:ring-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" class="w-8 h-8 text-white humbleicons hi-download-alt">
                                        <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v8.5m0 0l3-3m-3 3l-3-3M5 15v2a2 2 0 002 2h10a2 2 0 002-2v-2" />
                                    </svg>
                                </button>
                            </a>
                        </div>
                        <img src="../assets/forum/<?php echo $komentar['foto'] ?>" class="rounded-lg" />
                    </div>
                <?php endif ?>
            </div>
            <span
                class="text-sm font-normal text-secondary font-body"><?php echo date('d M Y H:i', strtotime($komentar['tanggal'])); ?></span>
        </div>
        <button id="dropdownMenuIconButton<?php echo $komentar['id_komentar']; ?>"
            data-dropdown-toggle="<?php echo $komentar['id_komentar']; ?>" data-dropdown-placement="bottom-start"
            class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-header bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 "
            type="button">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 4 15">
                <path
                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
            </svg>
        </button>
        <div id="<?php echo $komentar['id_komentar']; ?>"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 ">
            <ul class="py-2 text-sm text-header font-body" aria-labelledby="dropdownMenuIconButton">
                <li>
                    <button type="button"
                        class="block px-4 py-2 hover:bg-gray-200 w-full max-w-full font-body font-medium rounded-full text-sm me-1 mb-1 transition-all reply duration-300 ease-in-out transform active:scale-90"
                        data-nama="<?php echo $komentar['nama']; ?>"
                        data-komentar="<?php echo $komentar['id_komentar']; ?>">Reply</button>
                </li>
                <li>
                    <?php
                    if ($_SESSION['login']['id_anggota'] == $komentar['id_user']):
                        ?>
                        <button data-modal-target="popup-modal<?php echo $komentar['id_komentar']; ?>"
                            data-modal-toggle="popup-modal<?php echo $komentar['id_komentar']; ?>"
                            class="block px-4 py-2 hover:bg-gray-200 w-full max-w-full font-body font-medium rounded-full text-sm me-1 mb-1 transition-all reply duration-300 ease-in-out transform active:scale-90"
                            type="button">
                            Hapus
                        </button>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Popup Modal -->
<div id="popup-modal<?php echo $komentar['id_komentar']; ?>" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                data-modal-hide="popup-modal<?php echo $komentar['id_komentar']; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-times h-6 w-6">
                    <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                        <path d="M6 18L18 6M18 18L6 6" />
                    </g>
                </svg>
            </button>
            <div class="p-4 md:p-5 text-center">
                <lord-icon src="https://cdn.lordicon.com/vihyezfv.json" trigger="loop" delay="1000"
                    style="width:50px;height:50px">
                </lord-icon>
                <h3 class="mb-5 text-lg font-medium font-body text-secondary">Apakah kamu
                    yakin ini
                    menghapus data ini?</h3>
                <button data-modal-hide="popup-modal<?php echo $komentar['id_komentar']; ?>" type="button"
                    class="text-white font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90"
                    style="background-color: #FF5861;">
                    <a href="delete_comment.php?id_komentar=<?php echo $komentar['id_komentar']; ?>"
                        class="flex items-center">
                        Ya, Hapus
                    </a>
                </button>
                <button data-modal-hide="popup-modal<?php echo $komentar['id_komentar']; ?>" type="button"
                    class="text-secondary bg-gray-200 font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90">
                    Tidak, Batalkan</button>
            </div>
        </div>
    </div>
</div>

<?php
$id_komentar = $komentar['id_komentar'];
$result = query("SELECT reply.*, anggota.nama, anggota.nim, anggota.foto AS anggota_foto FROM reply INNER JOIN anggota ON anggota.id_anggota = reply.id_user WHERE id_komentar=$id_komentar");
foreach ($result as $reply): ?>
    <?php
    include '../forum/reply.php';
?>
<?php endforeach; ?>