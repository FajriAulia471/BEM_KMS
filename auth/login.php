<?php
session_start();
include '../templates/header.php';
require '../function/functions.php';

if (isset($_COOKIE['id_anggota']) && isset($_COOKIE['key'])) {
    $id_anggota = $_COOKIE['id_anggota'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota = $id_anggota");
    $row = mysqli_fetch_array($result);

    if ($row) {
        if ($key === hash('sha256', $row['nim'])) {
            $_SESSION['login'] = [
                'id_anggota' => $row['id_anggota'],
                'nim' => $row['nim'],
                'nama' => $row['nama'],
                'kementerian' => $row['kementerian']
            ];
        }
    }
}

if (isset($_SESSION['login']) && is_array($_SESSION['login']) && $_SESSION['login']['kementerian'] == 'KOMINFO') {
    header("Location: ../anggota/anggota.php");
    exit;
} else if (isset($_SESSION['login']) && is_array($_SESSION['login']) && $_SESSION['login']['kementerian'] == 'ADVOKASI') {
    header("Location: ../aspirasi/aspirasi.php");
    exit;
} else if (isset($_SESSION['login'])) {
    header("Location: ../repository/repository.php");
    exit;
}

if (isset($_POST['login'])) {
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM anggota WHERE nim='$nim'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION["login"] = [
                'id_anggota' => $row['id_anggota'],
                'nim' => $row['nim'],
                'nama' => $row['nama'],
                'kementerian' => $row['kementerian']
            ];

            if (isset($_POST['remember'])) {
                setcookie('id_anggota', $row['id_anggota'], time() + 864000, "/");
                setcookie('key', hash('sha256', $row['nim']), time() + 864000, "/");
            }

            if ($_SESSION['login']['kementerian'] == 'KOMINFO') {
                header("Location: ../anggota/anggota.php");
            } else if ($_SESSION['login']['kementerian'] == 'ADVOKASI') {
                header("Location: ../aspirasi/aspirasi.php");
            } else {
                header("Location: ../profile/profile.php");
            }
            exit;
        }
    }

    $error = true;
}
?>

<div class="bg-primary flex items-center justify-center h-screen px-3">
    <div class="w-full max-w-sm p-4 bg-primary border border-gray-200 rounded-2xl shadow-lg sm:p-6 md:p-8 ">
        <?php if (isset($error)): ?>
            <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-100 " role="alert">
                <lord-icon src="https://cdn.lordicon.com/keaiyjcx.json" trigger="loop" delay="1000"
                    style="width:25px;height:25px"></lord-icon>
                <div class="ms-3 text-sm font-medium">
                    NIM/Password salah!
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg p-1.5  inline-flex items-center justify-center h-8 w-8 "
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        <?php endif; ?>

        <h5 class="text-xl font-header font-extrabold text-header tracking-wider mt-3">Login!</h5>
        <form class="space-y-6 mb-5 mt-2 px-1" action="" method="post" autocomplete="off">
            <div>
                <label for="nim" class="block mb-2 text-md font-body font-medium text-header ">NIM Mahasiswa</label>
                <input type="text" name="nim" id="nim"
                    class="bg-white h-12 border border-gray-300 text-secondary text-md rounded-full block w-full p-2.5 font-body font-medium focus:ring-secondary focus:border-secondary"
                    placeholder="NIM" oninput="convertToUppercase(this)"
                    value="<?php echo isset($_POST['nim']) ? $_POST['nim'] : '' ?>" required>
            </div>
            <div>
                <label for="password" class="block mb-2 text-md font-body font-medium text-header">Password</label>
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
            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember"
                    class="w-4 h-4 text-header bg-gray-100 border-gray-300 rounded focus:ring-header focus:ring-2">
                <label for="remember" class="ms-2 text-md font-medium text-header font-body">Remember me</label>
            </div>
            <button type="submit" name="login" style="background-color: #291334;"
                class="focus:outline-none text-white font-medium rounded-full text-lg font-header px-5 py-2.5 me-2 mb-2 h-12 block w-full transition-all duration-300 ease-in-out transform active:scale-90 tracking-wider">Login</button>
        </form>
    </div>
</div>

<?php
include '../templates/footer.php';
?>