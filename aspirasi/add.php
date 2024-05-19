<?php
session_start();
// Mengecek jika session user kosong
if ($_SESSION['login']['kementerian'] != 'KOMINFO' && $_SESSION['login']['kementerian'] != 'ADVOKASI') {
    // Kembali ke halaman login
    header("Location: ../auth/logout.php");
    exit;
}

include '../function/functions.php';
include '../templates/header.php';

$_menuAktif = 'aspirasi';
$_submenuAktif = 'tambah_aspirasi';

if (isset($_POST["submit"])) {
    tambahAspirasi($_POST);
}
?>
<section class="" style="background-color: #FAF7F5">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <div class="flex items-center lg:hidden md:hidden sm:hidden mb-6">
            <a href="./aspirasi.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24"
                    class="humbleicons hi-arrow-left w-8 h-8 transition-all duration-300 ease-in-out transform active:scale-90"
                    style="color: #291334;">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6" />
                </svg></a>
            <h1 class="flex-grow text-header font-bold text-xl justify-end ms-3">Tambah Aspirasi</h1>
        </div>

        <h1 class="text-header font-bold text-3xl text-center mt-4 mb-6 hidden lg:block md:block sm:block">Tambah
            Aspirasi</h1>

        <form class="max-w-md mx-auto px-3" action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <?php
            if (isset($_SESSION["error"])): ?>
                <div id="alert-error" class="flex items-center p-4 mb-4 mt-5 text-red-800 rounded-lg bg-red-100"
                    role="alert">
                    <lord-icon src="https://cdn.lordicon.com/keaiyjcx.json" trigger="loop" delay="1000"
                        style="width:25px;height:25px"></lord-icon>
                    <div class="ms-3 text-sm font-medium">
                        <?php echo $_SESSION["error"] ?>
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-error" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <?php unset($_SESSION["error"]); ?>
            <?php endif ?>

            <div class="mb-5">
                <label for="aspirasi" class="block mb-2 text-md font-medium text-header font-body">Aspirasi
                    Mahasiswa</label>
                <input type="text" name="aspirasi" id="aspirasi"
                    class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                    required placeholder="Aspirasi Mahasiswa ...">
            </div>
            <div class="mb-5">
                <label for="deskripsi" class="block mb-2 text-md font-medium text-header font-body">Deskripsi</label>
                <textarea type="text" name="deskripsi" id="deskripsi" rows="4"
                    class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-xl block w-full p-3 focus:ring-secondary focus:border-secondary"
                    placeholder="Deskripsi ..." required></textarea>
            </div>

            <button type="submit" name="submit" style="background-color: #291334;"
                class="focus:outline-none text-white font-medium rounded-full text-lg font-header px-5 py-2.5 me-2 mb-2 h-12 block w-full transition-all duration-300 ease-in-out transform active:scale-90 tracking-wider">
                Submit</button>
        </form>
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