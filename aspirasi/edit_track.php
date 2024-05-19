<?php
// cek session
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

$id_track = $_GET["id_track"];

if (isset($_POST["submit"])) {
    ubahTrack($_POST['id_track'], $_POST);
}
?>
<section class="" style="background-color: #FAF7F5">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <div class="flex items-center lg:hidden md:hidden sm:hidden mb-6">
            <?php
            if ($id_track) {
                $result = query("SELECT * FROM tracking WHERE id_track=$id_track");
                if ($result) {
                    $data = $result[0];
                    ?>
                    <a href="./track.php?id_aspirasi=<?php echo $data['id_aspirasi']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-arrow-left w-8 h-8 transition-all duration-300 ease-in-out transform active:scale-90"
                            style="color: #291334;">
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6" />
                        </svg></a>

                    <h1 class="flex-grow text-header font-bold text-xl justify-end ms-3">Ubah Proses</h1>
                <?php } else {
                    header("Location: ../aspirasi/aspirasi.php");
                    exit;
                } ?>
            <?php } else {
                header("Location: ../aspirasi/aspirasi.php");
                exit;
            } ?>
        </div>

        <h1 class="text-header font-bold text-3xl text-center mt-4 mb-6 hidden lg:block md:block sm:block">Ubah
            Proses</h1>

        <?php
        if ($id_track) {
            $result = query("SELECT * FROM tracking WHERE id_track=$id_track");
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
                    <div class="mb-5">
                        <label for="status" class="block mb-2 text-md font-medium text-header font-body">Status</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                            required>
                            <option value="" disabled selected>Pilih Status ...</option>
                            <option value="SEDANG BERJALAN">SEDANG BERJALAN</option>
                            <option value="SELESAI">SELESAI</option>
                            <?php
                            $statusOptions = array("SEDANG BERJALAN", "SELESAI");

                            foreach ($statusOptions as $option) {
                                $selected = ($data["status"] == $option) ? "selected" : "";

                                echo "<option value='$option' $selected>$option</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="tanggal" class="block mb-2 text-md font-medium text-header font-body">Tanggal</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    class="humbleicons hi-calendar w-6 h-6 text-gray-500">
                                    <g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2">
                                        <path stroke-linejoin="round" d="M4 6a1 1 0 011-1h14a1 1 0 011 1v4H4V6z" />
                                        <path stroke-linecap="round" d="M8 6.5v-3M16 6.5v-3" />
                                        <path stroke-linejoin="round" d="M4 10h16v9a1 1 0 01-1 1H5a1 1 0 01-1-1v-9z" />
                                    </g>
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide type="text" id="tanggal" name="tanggal"
                                class="block w-full p-4 ps-10 text-md text-secondary font-body border border-gray-300 rounded-full bg-gray-50 focus:ring-secondary focus:border-secondary"
                                placeholder="Pilih Tanggal" required readonly value="<?php echo $data['tanggal'] ?>">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="proses" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Progress
                            Aspirasi</label>
                        <textarea id="proses" name="proses" rows="4"
                            class="block p-2.5 w-full text-md text-secondary bg-gray-50 font-body rounded-xl border border-gray-300 focus:ring-secondary focus:border-secondary"
                            placeholder="Progress Aspirasi ..."><?php echo $data['proses'] ?></textarea>
                    </div>
                    <?php if (!empty($data["foto"])): ?>
                        <div class="mb-5">
                            <label for="foto_sebelumnya" class="block mb-2 text-md font-medium text-header font-body">Foto
                                Lama</label>
                            <img class="h-auto max-w-full rounded-xl" src="../assets/aspirasi/<?php echo $data["foto"] ?>"
                                alt="Aspirasi Mahasiswa">
                        </div>
                    <?php endif ?>
                    <div class="mb-5">
                        <label for="foto" class="block mb-2 text-md font-medium text-header font-body">Foto
                            Baru</label>
                        <input
                            class="block w-full text-md font-body text-secondary border border-gray-300 rounded-full cursor-pointer bg-gray-50 "
                            aria-describedby="file_input_help" id="foto" name="foto" type="file">
                        <p class="mt-1 text-sm font-body text-secondary" id="file_input_help">PNG, JPG, JPEG</p>
                        <p class="mt-1 text-sm font-body text-yellow-400" id="file_input_help">Biarkan kosong jika tidak ada
                            pembaharuan foto!</p>
                    </div>
                    <input type="hidden" id="fotoLama" name="fotoLama" value="<?php echo $data["foto"]; ?>">
                    <input type="hidden" value="<?php echo $data['id_track']; ?>" name="id_track">
                    <input type="hidden" value="<?php echo $data['id_aspirasi']; ?>" name="id_aspirasi">
                    <div class="flex justify-end">
                        <button type="submit" name="submit" value="submit" style="background-color: #291334;"
                            class=" p-3 mt-4 ms-2 text-sm font-medium text-white  rounded-full border transition-all duration-300 ease-in-out transform active:scale-90 font-body">Submit
                            Progress</button>
                    </div>
                </form>
            <?php } else { ?>
                <h3 class="text-header font-bold text-xl text-center mt-1 mb-4">
                    Data tidak ditemukan
                </h3>
            <?php } ?>
        <?php } else { ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
<?php
include '../templates/footer.php';
?>