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

// ambil data di URL
$id_anggota = $_GET["id_anggota"];

if (isset($_POST["submit"])) {
    ubahAnggota($_POST['id_anggota'], $_POST);
}
?>
<section class="" style="background-color: #FAF7F5">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <div class="flex items-center lg:hidden md:hidden sm:hidden mb-6">
            <!-- Left-aligned arrow icon -->
            <a href="./anggota.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24"
                    class="humbleicons hi-arrow-left w-8 h-8 transition-all duration-300 ease-in-out transform active:scale-90"
                    style="color: #291334;">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6" />
                </svg></a>
            <!-- Center-aligned heading -->
            <h1 class="flex-grow text-header font-bold text-xl justify-end ms-3">Ubah Anggota</h1>
        </div>

        <h1 class="text-header font-bold text-3xl text-center mt-4 mb-6 hidden lg:block md:block sm:block">Ubah
            Anggota</h1>

        <?php
        // Jika id_anggota ada maka ...
        if ($id_anggota) {
            // Mengambil data anggota dari database
            $result = query("SELECT * FROM anggota WHERE id_anggota=$id_anggota");
            if ($result) {
                $data = $result[0];
                ?>
                <form class="max-w-md mx-auto px-3" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <?php
                    if (isset($_SESSION["error"])): ?>
                        <!-- Alert error jika ada -->
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

                    <!-- Form untuk mengubah data anggota -->
                    <div class="mb-5">
                        <label for="nim" class="block mb-2 text-md font-medium text-header font-body">NIM</label>
                        <input type="text" name="nim" id="nim"
                            class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                            placeholder="NIM ..." value="<?php echo htmlspecialchars($data['nim']); ?>"
                            oninput="convertToUppercase(this)" required>
                    </div>
                    <div class="mb-5">
                        <label for="nama" class="block mb-2 text-md font-medium text-header font-body">Nama Mahasiswa</label>
                        <input type="text" name="nama" id="nama"
                            class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                            placeholder="Nama Mahasiswa ..." value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                    </div>
                    <div class="mb-5">
                        <label for="foto_sebelumnya" class="block mb-2 text-md font-medium text-header font-body">Foto
                            Lama</label>
                        <img src="../assets/profile/<?php echo $data["foto"] ?>" alt=""
                            class="p-1 rounded-full ring-2 ring-gray-300" id="foto_sebelumnya" name="foto_sebelumnya"
                            width="100">
                    </div>
                    <div class="mb-5">
                        <label for="foto" class="block mb-2 text-md font-medium text-header font-body">Foto Baru</label>
                        <input
                            class="block w-full text-md font-body text-secondary border border-gray-300 rounded-full cursor-pointer bg-gray-50 "
                            aria-describedby="file_input_help" id="foto" name="foto" type="file">
                        <p class="mt-1 text-sm font-body text-secondary" id="file_input_help">PNG, JPG, JPEG</p>
                        <p class="mt-1 text-sm font-body text-yellow-400" id="file_input_help">Biarkan kosong jika tidak ada
                            pembaharuan foto!</p>
                    </div>
                    <div class="mb-5">
                        <label for="kementerian"
                            class="block mb-2 text-md font-medium text-header font-body">Kementerian</label>
                        <select id="kementerian" name="kementerian"
                            class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                            required>
                            <option value="" disabled>Pilih Kementerian ...</option>
                            <?php
                            $kementerianOptions = array("PRESIDEN", "WAKIL PRESIDEN", "KEUANGAN", "SEKRETARIS", "KOMINFO", "MENKO INTERNAL", "KEMENDAGRI", "ADVOKASI", "PSDM", "PEMBERDAYAAN PEREMPUAN", "EKRAF", "MENKO RELASI PUBLIK", "KASTRAT", "KEMENLU", "KEMENSOS");

                            foreach ($kementerianOptions as $option) {
                                $selected = ($data["kementerian"] == $option) ? "selected" : "";
                                echo "<option value='$option' $selected>$option</option>";
                            }
                            ?>
                        </select>
                        <p id="helper-text-explanation" class="mt-2 text-sm text-secondary font-body">Kementerian KOMINFO akan
                            berfungsi sebagai admin</p>
                    </div>

                    <input type="hidden" id="fotoLama" name="fotoLama" value="<?php echo $data["foto"]; ?>">
                    <input type="hidden" name="id_anggota" value="<?php echo htmlspecialchars($id_anggota); ?>">
                    <button type="submit" name="submit" style="background-color: #291334;"
                        class="focus:outline-none text-white font-medium rounded-full text-lg font-header px-5 py-2.5 me-2 mb-2 h-12 block w-full transition-all duration-300 ease-in-out transform active:scale-90 tracking-wider">
                        Submit</button>
                </form>
            <?php } else { ?>
                <!-- Jika data tidak ditemukan -->
                <h3 class="text-header font-bold text-xl text-center mt-1 mb-4">
                    Data tidak ditemukan
                </h3>
            <?php } ?>
        <?php } else { ?>
            <!-- Jika id_anggota tidak ada -->
            <h3 class="text-header font-bold text-xl text-center mt-1 mb-4">
                Data tidak ditemukan
            </h3>
        <?php } ?>

    </div>
    <div class="row mt-10">
        <br>
        <br>
    </div>
</section>

<?php
include '../templates/footer.php';
?>