<?php
include '../function/functions.php';
include '../templates/header.php';

// cek session
session_start();
// Mengecek jika session user kosong
if ($_SESSION['login']['kementerian'] != 'KOMINFO') {
    // Kembali ke halaman login
    header("Location: ../auth/logout.php");
    exit;
}

$_menuAktif = 'anggota';
$_submenuAktif = 'lihat_anggota';

$keyword = ""; // Initialize $keyword variable

if (isset($_POST['searchButton'])) {
    $keyword = $_POST['keyword'];
    $_SESSION['keyword'] = $keyword;
} else {
    $keyword = isset($_SESSION['keyword']) ? $_SESSION['keyword'] : "";
}


// Konfigurasi Pagination
$jumlahDataPerhalaman = 10;
$jumlahData = count(query("SELECT * FROM anggota WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR kementerian LIKE '%$keyword%'"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET['halaman']) ? $_GET['halaman'] : 1);
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
$mahasiswa = query("SELECT * FROM anggota WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR kementerian LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerhalaman");
// End

?>

<section class="" style="background-color: #FAF7F5">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <h1 class="text-header font-bold text-3xl text-center mt-4 mb-6">Daftar Anggota</h1>
        <form action="" method="POST" autocomplete="off">
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
                        placeholder="Cari berdasarkan nama..." autofocus value="<?php echo $keyword; ?>">
                    <button type="submit" name="searchButton" style="background-color: #291334;"
                        class="text-white absolute end-2.5 bottom-2.5 font-medium rounded-full text-md px-4 py-2 transition-all duration-100 ease-in-out transform active:scale-90 font-body">Cari</button>
                </div>
            </div>
        </form>

        <div class="flex mt-2 justify-end">
            <a href="./add.php"
                class="focus:outline-none flex items-center text-white font-medium rounded-full text-md font-body px-4 py-2 me-2 mb-2 transition-all duration-300 ease-in-out transform active:scale-90 "
                style="background-color: #291334;">
                Tambah Anggota
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-plus h-6 w-6 ms-4">
                    <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                        <path d="M12 19V5M19 12H5" />
                    </g>
                </svg>
            </a>
        </div>

        <div class="flex mt-2 justify-end lg:hidden md:hidden sm:block">
            <a href="./add.php"
                class="focus:outline-none flex items-center text-brightRed font-medium rounded-full text-md font-body px-4 py-2 me-2 mb-2 transition-all duration-300 ease-in-out transform active:scale-90 "
                style="background-color: #291334;">
                Dashboard
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-dashboard h-6 w-6 ms-4 text-brightRed">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2"
                        d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zm10-3a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z" />
                </svg>
            </a>
        </div>

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


        <div class="relative overflow-x-auto shadow-xl rounded-lg mt-5">
            <table class="w-full text-md font-body text-left text-gray-500">
                <thead class="text-xs  text-secondary uppercase" style="background-color: #EFEAE6">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            NIM
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Nama Mahasiswa
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Kementerian
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span class="sr-only">Edit</span>
                            <span class="sr-only">Hapus</span>
                        </th>
                    </tr>
                </thead>
                <?php if (!empty($mahasiswa) > 0) { ?>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mahasiswa as $data): ?>
                            <tr class="bg-white border-b hover:bg-gray-100">
                                <td class="px-6 py-4">
                                    <?php echo $i ?>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap space-x-4 ">
                                    <?php echo $data["nim"] ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $data["nama"] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <img src="../assets/profile/<?php echo $data["foto"] ?>" alt=""
                                        class="p-1 rounded-full ring-2 ring-gray-300" width="100" height="100"
                                        style="max-height:100; max-width: 100;">
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $data["kementerian"] ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex space-x-4 justify-center">
                                        <a href="edit.php?id_anggota=<?php echo $data["id_anggota"] ?>"
                                            class="text-header font-medium rounded-full text-sm px-5 py-2.5 text-center transition-all duration-100 ease-in-out transform active:scale-90"
                                            style="background-color: #FFBE00;">
                                            Edit
                                        </a>
                                        <a href="auth.php?id_anggota=<?php echo $data["id_anggota"] ?>"
                                            class="text-header font-medium rounded-full text-sm px-5 py-2.5 text-center transition-all duration-100 ease-in-out transform active:scale-90"
                                            style="background-color: #00B5FF;">
                                            Password
                                        </a>
                                        <?php if ($_SESSION['login']['id_anggota'] != $data['id_anggota']) { ?>
                                            <button data-modal-target="<?php echo $data['id_anggota']; ?>"
                                                data-modal-toggle="<?php echo $data['id_anggota']; ?>"
                                                class="text-header font-medium rounded-full text-sm px-5 py-2.5 text-center transition-all duration-100 ease-in-out transform active:scale-90"
                                                type="button" style="background-color: #FF5861;">
                                                Hapus
                                            </button>
                                        <?php } ?>
                                    </div>
                                    <!-- Popup Modal -->
                                    <div id="<?php echo $data['id_anggota']; ?>" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                    data-modal-hide="<?php echo $data['id_anggota']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" class="humbleicons hi-times h-6 w-6">
                                                        <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                                                            stroke-linecap="round" stroke-width="2">
                                                            <path d="M6 18L18 6M18 18L6 6" />
                                                        </g>
                                                    </svg>
                                                </button>
                                                <div class="p-4 md:p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/vihyezfv.json" trigger="loop"
                                                        delay="1000" style="width:50px;height:50px">
                                                    </lord-icon>
                                                    <h3 class="mb-5 text-lg font-medium font-body text-secondary">Apakah kamu
                                                        yakin ini
                                                        menghapus data ini?</h3>
                                                    <button data-modal-hide="<?php echo $data['id_anggota']; ?>" type="button"
                                                        class="text-white font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90"
                                                        style="background-color: #FF5861;">
                                                        <a href="delete.php?id_anggota=<?php echo $data["id_anggota"] ?>"
                                                            class="flex items-center">
                                                            Ya, Hapus
                                                        </a>
                                                    </button>
                                                    <button data-modal-hide="<?php echo $data['id_anggota']; ?>" type="button"
                                                        class="text-secondary bg-gray-200 font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90">
                                                        Tidak, Batalkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                <?php } else { ?>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-header font-bold text-xl text-center mt-1 mb-4">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>

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
    <div class="row mt-10">
        <br>
        <br>
    </div>
</section>

<?php
// mengimpor file bagian footer
include '../templates/footer.php';
?>