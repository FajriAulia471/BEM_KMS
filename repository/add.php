<?php
// cek session
session_start();
// Mengecek jika session user kosong
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/logout.php");
    exit;
}

include '../function/functions.php';
include '../templates/header.php';

$_menuAktif = 'repository';
$_submenuAktif = 'tambah_repository';

if (isset($_POST["submit"])) {
    tambahRepository($_POST);
}
?>
<section class="bg-primary">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <div class="flex items-center lg:hidden md:hidden sm:hidden mb-6">
            <a href="./repository.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24"
                    class="humbleicons hi-arrow-left w-8 h-8 transition-all duration-300 ease-in-out transform active:scale-90"
                    style="color: #291334;">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6" />
                </svg></a>
            <h1 class="flex-grow text-header font-bold text-xl justify-end ms-3">Tambah Repository</h1>
        </div>

        <h1 class="text-header font-bold text-3xl text-center mt-4 mb-6 hidden lg:block md:block sm:block">Tambah
            Repository</h1>

        <form class="max-w-md mx-auto px-3" action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <?php
            if (isset($_SESSION["success"])): ?>
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
                        data-dismiss-target="#alert-success" aria-label="Close">
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
                <label for="kementerian"
                    class="block mb-2 text-md font-medium text-header font-body">Kementerian</label>
                <input type="text" name="kementerian" id="kementerian"
                    class="bg-gray-200 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                    value="<?php echo $_SESSION['login']['kementerian'] ?>" readonly required>
            </div>
            <div class="mb-5">
                <label for="kategori" class="block mb-2 text-md font-medium text-header font-body">Kategori</label>
                <select id="kategori" name="kategori"
                    class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                    required>
                    <option value="" disabled selected>Pilih Kategori ...</option>
                    <option value="EVALUASI">EVALUASI</option>
                    <option value="PENGETAHUAN">PENGETAHUAN</option>
                    <option value="PEKERJAAN SELESAI">PEKERJAAN SELESAI</option>
                    <option value="PEKERJAAN BELUM SELESAI">PEKERJAAN BELUM SELESAI</option>
                    <option value="ASPIRASI MAHASISWA">ASPIRASI MAHASISWA</option>>
                </select>
            </div>
            <div class="mb-5">
                <label for="keterangan" class="block mb-2 text-md font-medium text-header font-body">Keterangan</label>
                <textarea type="text" name="keterangan" id="keterangan" rows="4"
                    class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-xl block w-full p-3 focus:ring-secondary focus:border-secondary"
                    placeholder="Keterangan ..." required></textarea>
                <p id="helper-text-explanation" class="mt-2 text-sm text-secondary font-body">Berisi keterangan dari
                    berkas
                </p>
            </div>
            <div class="mb-5">
                <label for="file_input" class="block mb-2 text-md font-medium text-header font-body">Upload
                    Berkas</label>
                <input
                    class="block w-full text-md font-body text-secondary border border-gray-300 rounded-full cursor-pointer bg-gray-50 focus:ring-secondary focus:border-secondary"
                    aria-describedby="file_input_help" id="file_input" name="berkas" type="file">
                <p class="mt-1 text-sm font-body text-red-400" id="file_input_help">Hanya PDF!</p>
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