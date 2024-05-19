<?php
include '../function/functions.php';
include '../templates/header.php';

// cek session
session_start();
// Mengecek jika session user kosong
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/logout.php");
    exit;
}

$_menuAktif = 'profile';

// Ensure $_SESSION['login']['id_anggota'] exists and is numeric
if (!isset($_SESSION['login']['id_anggota']) || !is_numeric($_SESSION['login']['id_anggota'])) {
    $_SESSION["error"] = "ID pengguna tidak valid.";
    header("Location: ../auth/logout.php");
    exit;
}

// Ambil data user
$id_anggota = $_SESSION['login']['id_anggota'];
$sql = "SELECT * FROM anggota WHERE id_anggota=$id_anggota";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    ubahProfile($_POST['id_anggota'], $_POST);
}
?>

<section class="bg-primary">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <h1 class="flex justify-center font-header text-xl mt-6 mb-4">Profile Pengguna</h1>

        <form class="max-w-md mx-auto px-3" action="" method="post" autocomplete="off">
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
            <div class="flex items-center justify-center gap-4 mt-8 mb-4">
                <img class="w-20 h-20 p-1 rounded-full ring-2 ring-gray-300"
                    src="../assets/profile/<?php echo ($data['foto']) ?>" alt="">
                <div class="font-medium font-body ">
                    <div class="text-md text-header">
                        <?php echo ($data['nama']); ?>
                    </div>
                    <div class="text-sm text-secondary">
                        <?php echo ($data['kementerian']); ?>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label for="nama" class="block mb-2 text-md font-medium text-header font-body">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="bg-gray-50 border border-gray-300 text-secondary text-md font-body rounded-full block w-full p-3 focus:ring-secondary focus:border-secondary"
                    placeholder="Nama ..." required value="<?php echo ($data['nama']); ?>">
            </div>
            <hr class="w-48 h-1 mx-auto my-4 bg-gray-300 border-0 rounded md:my-10">
            <p class="text-md font-body text-red-500 mb-5">* Kosongkan jika tidak diganti</p>

            <!-- Password Baru -->
            <div class="mb-5 ">
                <label for="password_baru" class="block mb-2 text-md font-medium text-header font-body">Password
                    Baru</label>
                <div class="flex items-center">
                    <input type="password" name="password_baru" id="password_baru" placeholder="Password Baru ..."
                        class="bg-white border h-12 border-gray-300 text-secondary text-md rounded-full block w-full p-3 font-body font-medium focus:ring-secondary focus:border-secondary">
                    <button type="button" onclick="togglePasswordBaruVisibility()"
                        class="p-2 ms-2 text-sm font-medium text-white rounded-full border transition-all duration-300 ease-in-out transform active:scale-90"
                        style="background-color: #291334;" id="eye-button-baru">
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

            <!-- Konfirmasi Password -->
            <div class="mb-5 ">
                <label for="konfirmasi_password" class="block mb-2 text-md font-medium text-header font-body">Konfirmasi
                    Password</label>
                <div class="flex items-center">
                    <input type="password" name="konfirmasi_password" id="konfirmasi_password"
                        placeholder="Konfirmasi Password ..."
                        class="bg-white border h-12 border-gray-300 text-secondary text-md rounded-full block w-full p-3 font-body font-medium focus:ring-secondary focus:border-secondary">
                    <button type="button" onclick="togglePasswordKonfirmasiVisibility()"
                        class="p-2 ms-2 text-sm font-medium text-white rounded-full border transition-all duration-300 ease-in-out transform active:scale-90"
                        style="background-color: #291334;" id="eye-button-konfirmasi">
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
                class="focus:outline-none text-white font-medium rounded-full text-lg font-header px-5 py-2.5 me-2 mb-2 h-12 block w-full transition-all duration-300 ease-in-out transform active:scale-90 tracking-wider">
                Submit</button>
        </form>
        <div class="max-w-md mx-auto px-3 flex justify-end">
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="text-header font-body font-medium rounded-full text-sm px-5 py-2.5 text-center transition-all duration-100 ease-in-out transform active:scale-90 flex items-center"
                type="button" style="background-color: #FF5861;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    class="humbleicons hi-logout h-4 w-4 mr-2" style="color: #291334;">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2"
                        d="M20 12h-9.5m7.5 3l3-3-3-3m-5-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h5a2 2 0 002-2v-1" />
                </svg>
                Logout
            </button>
            <!-- Popup Modal -->
            <div id="popup-modal" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="popup-modal">
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
                            <h3 class="mb-5 text-lg font-medium font-body text-secondary">Apakah kamu yakin ingin
                                melakukan logout?</h3>
                            <button data-modal-hide="popup-modal" type="button"
                                class="text-white font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90"
                                style="background-color: #FF5861;">
                                <a href="../auth/logout.php" class="flex items-center">
                                    Logout
                                </a>
                            </button>
                            <button data-modal-hide="popup-modal" type="button"
                                class="text-secondary bg-gray-200 font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90">
                                Batalkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-10">
        <br>
        <br>
    </div>
</section>

<script>
    function togglePasswordBaruVisibility() {
        var passwordInput = document.getElementById("password_baru");
        var eyeButton = document.getElementById("eye-button-baru");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeButton.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="humbleicons hi-eye-off h-6 w-6"><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5l16 16M11.148 9.123a3 3 0 013.722 3.752M8.41 6.878C12.674 4.762 17.267 6.47 21 12c-1.027 1.521-2.119 2.753-3.251 3.696m-2.509 1.59C11.076 19.142 6.631 17.38 3 12c1.01-1.496 2.083-2.713 3.196-3.65"/></svg>';
        } else {
            passwordInput.type = "password";
            eyeButton.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="humbleicons hi-eye h-6 w-6"><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M3 12c5.4-8 12.6-8 18 0-5.4 8-12.6 8-18 0z" /><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>';
        }
    }

    function togglePasswordKonfirmasiVisibility() {
        var passwordInput = document.getElementById("konfirmasi_password");
        var eyeButton = document.getElementById("eye-button-konfirmasi");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeButton.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="humbleicons hi-eye-off h-6 w-6"><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5l16 16M11.148 9.123a3 3 0 013.722 3.752M8.41 6.878C12.674 4.762 17.267 6.47 21 12c-1.027 1.521-2.119 2.753-3.251 3.696m-2.509 1.59C11.076 19.142 6.631 17.38 3 12c1.01-1.496 2.083-2.713 3.196-3.65"/></svg>';
        } else {
            passwordInput.type = "password";
            eyeButton.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="humbleicons hi-eye h-6 w-6"><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M3 12c5.4-8 12.6-8 18 0-5.4 8-12.6 8-18 0z" /><path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>';
        }
    }
</script>
<?php
include '../templates/footer.php';
?>