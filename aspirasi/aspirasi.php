<?php
include '../function/functions.php';
include '../templates/header.php';

// cek session
session_start();
// Mengecek jika session user kosong
if ($_SESSION['login']['kementerian'] != 'KOMINFO' && $_SESSION['login']['kementerian'] != 'ADVOKASI') {
    // Kembali ke halaman login
    header("Location: ../auth/logout.php");
    exit;
}

$_menuAktif = 'aspirasi';
$_submenuAktif = 'lihat_aspirasi';

if (isset($_POST['searchButton'])) {
    $keyword = $_POST['keyword'];
    $_SESSION['keyword'] = $keyword;
} else {
    $keyword = isset($_SESSION['keyword']) ? $_SESSION['keyword'] : "";
}

// Konfigurasi Pagination
$jumlahDataPerhalaman = 10;
$jumlahData = count(query("SELECT * FROM aspirasi WHERE aspirasi LIKE '%$keyword%' ORDER BY tanggal DESC "));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET['halaman']) ? $_GET['halaman'] : 1);
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
$aspirasi = query("SELECT * FROM aspirasi WHERE aspirasi LIKE '%$keyword%' ORDER BY tanggal DESC LIMIT $awalData, $jumlahDataPerhalaman");
// End
?>

<section class="" style="background-color: #FAF7F5">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <h1 class="text-header font-bold text-3xl text-center mt-4 mb-6">Aspirasi Mahasiswa</h1>
        <form autocomplete="off" action="" method="POST">
            <div class="search">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-search w-6 h-6 text-gray-500">
                            <g xmlns=" http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" d="M20 20l-6-6" />
                                <path d="M15 9.5a5.5 5.5 0 11-11 0 5.5 5.5 0 0111 0z" />
                            </g>
                        </svg>
                    </div>
                    <input type="text" id="default-search" name="keyword"
                        class="block w-full p-4 ps-10 text-md text-secondary font-body border border-gray-300 rounded-full bg-gray-50 focus:ring-secondary focus:border-secondary"
                        placeholder="Cari berdasarkan aspirasi..." value="<?php echo $keyword; ?>">
                    <button type="submit" name="searchButton" style="background-color: #291334;"
                        class="text-white absolute end-2.5 bottom-2.5 font-medium rounded-full text-md px-4 py-2 transition-all duration-100 ease-in-out transform active:scale-90 font-body">Cari</button>
                </div>
            </div>
        </form>

        <div class="flex mt-2 justify-end">
            <a href="./add.php"
                class="focus:outline-none flex items-center text-white font-medium rounded-full text-md font-body px-4 py-2 me-2 mb-2 transition-all duration-300 ease-in-out transform active:scale-90"
                style="background-color: #291334;">
                Tambah Aspirasi
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-plus h-6 w-6 ms-4">
                    <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                        <path d="M12 19V5M19 12H5" />
                    </g>
                </svg>
            </a>
        </div>

        <?php if (isset($_SESSION["success"])): ?>
            <div id="alert-success" class="flex items-center p-4 mb-4 mt-5 text-green-800 rounded-lg bg-green-100"
                role="alert">
                <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="1000"
                    style="width:25px;height:25px">
                </lord-icon>
                <div class="ms-3 text-sm font-medium">
                    <?php echo $_SESSION["success"] ?>
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                    onclick="document.getElementById('alert-success').style.display = 'none';" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <?php unset($_SESSION["success"]); ?>
        <?php endif ?>

        <?php if (isset($_SESSION["update"])): ?>
            <div id="alert-update" class="flex items-center p-4 mb-4 mt-5 text-green-800 rounded-lg bg-green-100"
                role="alert">
                <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="1000"
                    style="width:25px;height:25px">
                </lord-icon>
                <div class="ms-3 text-sm font-medium">
                    <?php echo $_SESSION["update"] ?>
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                    onclick="document.getElementById('alert-update').style.display = 'none';" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <?php unset($_SESSION["update"]); ?>
        <?php endif ?>

        <?php if (isset($_SESSION["delete"])): ?>
            <div id="alert-delete" class="flex items-center p-4 mb-4 mt-5 text-green-800 rounded-lg bg-green-100"
                role="alert">
                <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="1000"
                    style="width:25px;height:25px">
                </lord-icon>
                <div class="ms-3 text-sm font-medium">
                    <?php echo $_SESSION["delete"] ?>
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                    onclick="document.getElementById('alert-delete').style.display = 'none';" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <?php unset($_SESSION["delete"]); ?>
        <?php endif ?>

        <hr class="w-48 h-1 mx-auto my-4 bg-gray-300 border-0 rounded md:my-10">
        <div class="row mx-auto">
            <?php if (!empty($aspirasi) > 0) { ?>
                <?php foreach ($aspirasi as $data): ?>
                    <div class="flex justify-end">
                        <p class="font-body text-sm text-secondary">
                            <?php echo date('d M Y H:i', strtotime($data['tanggal'])); ?>
                        </p>
                    </div>

                    <a href="track.php?id_aspirasi=<?php echo $data['id_aspirasi']; ?>">
                        <h5 class="mb-2 text-xl mt-1 font-semibold font-header tracking-wider underline"
                            style="color: #00B5FF; text-decoration-color: #00B5FF;">
                            <?php echo $data['aspirasi']; ?>
                        </h5>
                        <p class="font-body text-sm text-secondary">
                            <?php echo $data['deskripsi']; ?>
                        </p>
                    </a>

                    <div class="flex justify-end gap-4 mt-3">
                        <a href="edit_aspirasi.php?id_aspirasi=<?php echo $data['id_aspirasi']; ?>"
                            class="text-header font-medium rounded-full text-sm px-5 py-2.5 text-center transition-all duration-100 ease-in-out transform active:scale-90"
                            style="background-color: #FFBE00;">
                            Edit
                        </a>
                        <button data-modal-target="<?php echo $data['id_aspirasi']; ?>"
                            data-modal-toggle="<?php echo $data['id_aspirasi']; ?>"
                            class="text-header font-medium rounded-full text-sm px-5 py-2.5 text-center transition-all duration-100 ease-in-out transform active:scale-90"
                            type="button" style="background-color: #FF5861;">
                            Hapus
                        </button>
                    </div>
                    <!-- Popup Modal -->
                    <div id="<?php echo $data['id_aspirasi']; ?>" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="<?php echo $data['id_aspirasi']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" class="humbleicons hi-times h-6 w-6">
                                        <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                            stroke-width="2">
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
                                    <button data-modal-hide="<?php echo $data['id_aspirasi']; ?>" type="button"
                                        class="text-white font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90"
                                        style="background-color: #FF5861;">
                                        <a href="delete_aspirasi.php?id_aspirasi=<?php echo $data["id_aspirasi"] ?>"
                                            class="flex items-center">
                                            Ya, Hapus
                                        </a>
                                    </button>
                                    <button data-modal-hide="<?php echo $data['id_aspirasi']; ?>" type="button"
                                        class="text-secondary bg-gray-200 font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90">
                                        Tidak, Batalkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="h-1 my-4 bg-gray-200 border-0 rounded ">

                <?php endforeach; ?>
            <?php } else { ?>
                <h3 class="text-header font-bold text-xl text-center mt-3 mb-4">Data tidak ditemukan</h3>
            <?php } ?>

            <div class="flex flex-col items-center mt-8 mb-10">
                <!-- Help text -->
                <span class="text-md text-secondary font-body justify-center">
                    Menampilkan <span class="font-semibold text-header">
                        <?php echo min($halamanAktif * $jumlahDataPerhalaman, $jumlahData); ?>
                    </span>
                    data <span class="font-semibold text-header">
                        <?php echo $jumlahData ?>
                    </span> data keseluruhan
                </span>
                <div class="inline-flex mt-2 xs:mt-0 text-lg font-body">
                    <!-- Previous Button -->
                    <a href="?halaman=<?php echo max($halamanAktif - 1, 1); ?>"
                        class="flex items-center justify-center px-3 h-10 gap-6 text-white rounded-s-full transition-all duration-100 ease-in-out transform active:scale-90 "
                        style="background-color: #291334;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-arrow-left me-2 h-6 w-6">
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6" />
                        </svg>
                        Prev
                    </a>
                    <!-- Next Button -->
                    <a href="?halaman=<?php echo min($halamanAktif + 1, $jumlahHalaman); ?>"
                        class="flex items-center justify-center px-3 h-10 gap-6 text-white rounded-e-full transition-all duration-100 ease-in-out transform active:scale-90 "
                        style="background-color: #291334;">
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-arrow-right ms-2 h-6 w-6">
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M4 12h16m0 0l-6 6m6-6l-6-6" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

    </div>
    <div class="row mt-10">
        <br>
        <br>
    </div>
</section>

<?php
include '../templates/footer.php';
?>