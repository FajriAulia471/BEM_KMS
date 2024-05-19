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

$id_aspirasi = $_GET["id_aspirasi"];

$_menuAktif = 'aspirasi';

if (isset($_POST["submit"])) {
    tambahTrack($_POST['id_aspirasi'], $_POST);
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
            <h1 class="flex-grow text-header font-bold text-xl justify-end ms-3">Progress Aspirasi Mahasiswa</h1>
        </div>

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
            <div id="alert-error" class="flex items-center p-4 mb-4 mt-5 text-red-800 rounded-lg bg-red-100" role="alert">
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

        <?php
        $track = query("SELECT * FROM tracking WHERE id_aspirasi=$id_aspirasi");

        if (count($track) > 0) {
            foreach ($track as $status) {
                if ($status['status'] == "SELESAI"):
                    $alertDisplayed = true;
                    ?>
                    <div class="row mt-5 mb-5">
                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 font-body"
                            role="alert">
                            <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="1000"
                                style="width:25px;height:25px"></lord-icon>
                            <div>
                                <span class="font-medium ms-3 font-body text-md tracking-wide">Aspirasi mahasiswa sudah
                                    selesai!</span>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
                endif;
            }
        }
        ?>

        <?php
        // Jika id_anggota ada maka ...
        if ($id_aspirasi) {
            // Mengambil data anggota dari database
            $result = query("SELECT * FROM aspirasi WHERE id_aspirasi=$id_aspirasi");
            if ($result) {
                $data = $result[0]; ?>
                <div class="row mt-5 mb-5">
                    <h1 class="font-body text-xl text-header font-bold">
                        <?php echo $data['aspirasi'] ?>
                    </h1>
                    <h3 class="font-body text-lg text-header">
                        <?php echo $data['deskripsi'] ?>
                    </h3>
                    <time class="block mb-2 text-md font-normal font-body leading-none text-gray-400">
                        <?php echo date('d M Y H:i', strtotime($data['tanggal'])); ?>
                    </time>
                </div>

                <hr class="w-48 h-1 mx-auto my-4 bg-gray-300 border-0 rounded md:my-10">

                <ol class="relative border-s border-black mt-5">
                    <?php
                    $sql = query("SELECT * FROM tracking WHERE id_aspirasi=$id_aspirasi");
                    foreach ($sql as $track): ?>
                        <li class="mb-8 ms-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3"
                                style="background-color: #00B5FF;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    class="humbleicons hi-rocket w-4 h-4 text-white">
                                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M15 14l2.045-1.533C19.469 10.648 20.542 6.98 20 4c-2.981-.542-6.649.531-8.467 2.955L10 9m5 5l-3.5 2.5-4-4L10 9m5 5v2.667a4 4 0 01-.8 2.4l-.7.933-1-1M10 9H7.333a4 4 0 00-2.4.8L4 10.5l1 1M8.5 18L5 19l1.166-3.5m9.334-6a1 1 0 100-2 1 1 0 000 2z" />
                                </svg>
                            </span>
                            <time class="block mb-2 text-sm font-body font-normal leading-none text-gray-400">
                                <?php echo date('d M Y', strtotime($track['tanggal'])); ?>
                            </time>
                            <p class="text-base font-medium font-body text-header ">
                                <?php echo $track['proses'] ?>
                            </p>
                            <?php if (!empty($track['foto'])) { ?>
                                <img src="../assets/aspirasi/<?php echo $track['foto'] ?>" width="200" alt="proses aspirasi">
                            <?php } ?>
                            <p class="text-base font-normal font-body text-secondary ">
                                <?php echo $track['status'] ?>
                            </p>
                            <div class="flex justify-end mt-4">
                                <div class="flex">
                                    <a href="edit_track.php?id_track=<?php echo $track['id_track']; ?>"
                                        class="flex items-center font-body font-medium rounded-full text-sm px-0 py-0 me-2 mb-2 transition-all duration-300 ease-in-out transform active:scale-90"
                                        style="color: #FFBE00;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" class="humbleicons hi-pencil h-5 w-5 me-1">
                                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13.5 7.5l3 3M4 20v-3.5L15.293 5.207a1 1 0 011.414 0l2.086 2.086a1 1 0 010 1.414L7.5 20H4z" />
                                        </svg>
                                        Edit
                                    </a>
                                </div>
                                <button data-modal-target="<?php echo $track['id_track']; ?>"
                                    data-modal-toggle="<?php echo $track['id_track']; ?>"
                                    class="flex items-center font-body font-medium rounded-full text-sm px-0 py-0 me-2 mb-2 transition-all duration-300 ease-in-out transform active:scale-90"
                                    type="button" style="color: #FF5861;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        class="humbleicons hi-trash h-5 w-5 me-1">
                                        <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M6 6l.934 13.071A1 1 0 007.93 20h8.138a1 1 0 00.997-.929L18 6m-6 5v4m8-9H4m4.5 0l.544-1.632A2 2 0 0110.941 3h2.117a2 2 0 011.898 1.368L15.5 6" />
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                            <!-- Popup Modal -->
                            <div id="<?php echo $track['id_track']; ?>" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            data-modal-hide="<?php echo $track['id_track']; ?>">
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
                                            <button data-modal-hide="<?php echo $track['id_track']; ?>" type="button"
                                                class="text-white font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90"
                                                style="background-color: #FF5861;">
                                                <a href="delete_track.php?id_track=<?php echo $track['id_track'] ?>"
                                                    class="flex items-center">
                                                    Ya, Hapus
                                                </a>
                                            </button>
                                            <button data-modal-hide="<?php echo $track['id_track']; ?>" type="button"
                                                class="text-secondary bg-gray-200 font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90">
                                                Tidak, Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ol>

                <form class="max-w-full mx-auto" action="" method="post" autocomplete="off" enctype="multipart/form-data">
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
                                placeholder="Pilih Tanggal" required readonly>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="proses" class="block mb-2 text-md font-medium text-header font-body">Progress
                            Aspirasi</label>
                        <textarea id="proses" name="proses" rows="4"
                            class="block p-2.5 w-full text-md text-secondary bg-gray-50 font-body rounded-xl border border-gray-300 focus:ring-secondary focus:border-secondary"
                            placeholder="Progress Aspirasi ..."></textarea>
                    </div>
                    <div class="mb-5">
                        <label for="file_input" class="block mb-2 text-md font-medium text-header font-body">Upload
                            Foto</label>
                        <input
                            class="block w-full text-md font-body text-secondary border border-gray-300 rounded-full cursor-pointer bg-gray-50 "
                            aria-describedby="file_input_help" id="file_input" name="foto" type="file">
                        <p class="mt-1 text-sm font-body text-secondary" id="file_input_help">PNG, JPG, JPEG</p>
                    </div>
                    <input type="hidden" value="<?php echo $data['id_aspirasi']; ?>" name="id_aspirasi">
                    <div class="flex justify-end">
                        <button type="submit" name="submit" value="submit" style="background-color: #291334;"
                            class=" p-3 mt-4 ms-2 text-sm font-medium text-white  rounded-full border transition-all duration-300 ease-in-out transform active:scale-90 font-body">Submit
                            Progress</button>
                    </div>
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
    <div class="mt-10 mb-10">
        <br>
        <br>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
<script>
    // JavaScript untuk disable form jika alert aktif
    document.addEventListener("DOMContentLoaded", function () {
        // Mengambil nilai $alertDisplayed dari PHP dan menyimpannya dalam variabel JavaScript
        var alertDisplayed = <?php echo json_encode($alertDisplayed); ?>;
        if (alertDisplayed) {
            // jika alert tampil, form akan disable
            var form = document.querySelector('form');
            if (form) {
                // Lakukan perulangan pada semua elemen (input, pilih, area teks, tombol) dan disable
                form.querySelectorAll('input, select, textarea, button').forEach(function (element) {
                    element.disabled = true;
                });
            }
        }
    });
</script>
<?php
include '../templates/footer.php';
?>