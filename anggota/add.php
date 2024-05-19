<?php
// cek session
session_start();
// Mengecek jika session user kosong
if ($_SESSION['login']['kementerian'] != 'KOMINFO') {
    // Kembali ke halaman login
    header("Location: ../auth/logout.php");
    exit;
}

include '../function/functions.php';
include '../templates/header.php';

$_menuAktif = 'anggota';
$_submenuAktif = 'tambah_anggota';

if (isset($_POST["submit"])) {
    tambahAnggota($_POST);
}
?>

<section class="" style="background-color: #FAF7F5">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <div class="flex items-center lg:hidden md:hidden sm:hidden mb-6">
            <a href="./anggota.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24"
                    class="humbleicons hi-arrow-left w-8 h-8 transition-all duration-300 ease-in-out transform active:scale-90"
                    style="color: #291334;">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6" />
                </svg></a>
            <h1 class="flex-grow text-header font-bold text-xl justify-end ms-3">Tambah Anggota</h1>
        </div>

        <h1 class="text-header font-bold text-3xl text-center mt-4 mb-6 hidden lg:block md:block sm:block">Tambah
            Anggota</h1>

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
                <label for="nim" class="block mb-2 text-md font-medium text-header font-body">NIM</label>
                <input type="text" name="nim" id="nim"
                    class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                    placeholder="NIM ..." oninput="convertToUppercase(this)" required>
            </div>
            <div class="mb-5">
                <label for="nama" class="block mb-2 text-md font-medium text-header font-body">Nama Mahasiswa</label>
                <input type="text" name="nama" id="nama"
                    class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                    placeholder="Nama Mahasiswa ..." required>
            </div>
            <div class="mb-5">
                <label for="file_input" class="block mb-2 text-md font-medium text-header font-body">Upload
                    Foto</label>
                <input
                    class="block w-full text-md font-body text-secondary border border-gray-300 rounded-full cursor-pointer bg-gray-50 focus:ring-secondary focus:border-secondary"
                    aria-describedby="file_input_help" id="file_input" name="foto" type="file" required>
                <p class="mt-1 text-sm font-body text-secondary" id="file_input_help">PNG, JPG, JPEG</p>
            </div>
            <div class="mb-5">
                <label for="kementerian"
                    class="block mb-2 text-md font-medium text-header font-body">Kementerian</label>
                <select id="kementerian" name="kementerian"
                    class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                    required>
                    <option value="" disabled selected>Pilih Kementerian ...</option>
                    <option value="PRESIDEN">PRESIDEN</option>
                    <option value="WAKIL PRESIDEN">WAKIL PRESIDEN</option>
                    <option value="KEUANGAN">KEUANGAN</option>
                    <option value="SEKRETARIS">SEKRETARIS</option>
                    <option value="KOMINFO">KOMINFO</option>
                    <option value="MENKO INTERNAL">MENKO INTERNAL</option>
                    <option value="KEMENDAGRI">KEMENDAGRI</option>
                    <option value="ADVOKASI">ADVOKASI</option>
                    <option value="PSDM">PSDM</option>
                    <option value="PEMBERDAYAAN PEREMPUAN">PEMBERDAYAAN PEREMPUAN</option>
                    <option value="EKRAF">EKRAF</option>
                    <option value="MENKO RELASI PUBLIK">MENKO RELASI PUBLIK</option>
                    <option value="KASTRAT">KASTRAT</option>
                    <option value="KEMENLU">KEMENLU</option>
                    <option value="KEMENSOS">KEMENSOS</option>
                </select>
                <p id="helper-text-explanation" class="mt-2 text-sm text-secondary font-body">Kementerian
                    KOMINFO akan berfungsi sebagai admin</p>
            </div>
            <div class="mb-5 ">
                <label for="nim" class="block mb-2 text-md font-medium text-header font-body">Password</label>
                <div class="flex items-center">
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="bg-white border h-12 border-gray-300 text-secondary text-md rounded-full block w-full p-2.5 font-body font-medium focus:ring-secondary focus:border-secondary"
                        required>
                    <button type="button" onclick="togglePasswordVisibility()" style="background-color: #291334;"
                        class="p-2 ms-2 text-sm font-medium text-white rounded-full border transition-all duration-300 ease-in-out transform active:scale-90"
                        id="eye-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-eye h-6 w-6">
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round"
                                stroke-width="2" d="M3 12c5.4-8 12.6-8 18 0-5.4 8-12.6 8-18 0z" />
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round"
                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" name="submit" style="background-color: #291334;"
                class="text-white font-medium rounded-full text-lg font-header px-5 py-2.5 me-2 mb-2 h-12 block w-full transition-all duration-300 ease-in-out transform active:scale-90 tracking-wider">
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