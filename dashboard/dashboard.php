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

$_menuAktif = 'dashboard';

date_default_timezone_set("Asia/Jakarta");

function salam()
{
    $waktu = date("H");

    if ($waktu >= 5 && $waktu < 11) {
        $greeting = "Pagi";
    } elseif ($waktu >= 11 && $waktu < 16) {
        $greeting = "Siang";
    } elseif ($waktu >= 16 && $waktu < 19) {
        $greeting = "Sore";
    } else {
        $greeting = "Malam";
    }
    return "Selamat " . $greeting . ", ";
}

function profile($conn)
{
    $sql = "SELECT * FROM anggota WHERE id_anggota={$_SESSION['login']['id_anggota']}";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

$query = $conn->query("SELECT kementerian, COUNT(*) AS jumlah_berkas FROM repository GROUP BY kementerian");
foreach ($query as $data) {
    $kementerian[] = $data['kementerian'];
    $jumlahBerkas[] = $data['jumlah_berkas'];
}

?>
<section class="" style="background-color: #FAF7F5">
    <?php
    require '../templates/nav_dekstop.php';
    require '../templates/nav_mobile.php';
    ?>
    <div class="container p-3 mx-auto ">
        <div class="row mx-auto">
            <div class=" mt-0 p-2  border-gray-200 rounded-lg flex justify-between">
                <div class="flex items-center gap-4">
                    <div class="font-medium font-body">
                        <h5 class="text-xl font-bold font-header text-header tracking-wider">
                            <?php echo salam() . profile($conn)['nama'] . "!" ?>
                        </h5>
                    </div>
                </div>

                <div class="flex justify-end gap-1">
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                        class="text-header font-medium font-body h-10 rounded-full text-sm px-3 py-1 text-center transition-all duration-100 ease-in-out transform active:scale-90"
                        style="background-color: #FF5861;" type="button">
                        Logout
                    </button>
                </div>
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
                                <h3 class="mb-5 text-lg font-medium font-body text-secondary">Apakah kamu
                                    yakin ingin logout?</h3>
                                <button data-modal-hide="popup-modal" type="button"
                                    class="text-header font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90"
                                    style="background-color: #FF5861;">
                                    <a href="../auth/logout.php" class="flex items-center">
                                        Logout
                                    </a>
                                </button>
                                <button data-modal-hide="popup-modal" type="button"
                                    class="text-secondary bg-gray-200 font-medium font-body rounded-full text-md inline-flex items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90">
                                    Tidak, Batalkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <hr class="w-1/2 h-1 mx-auto my-4 bg-gray-200 border-0 rounded">

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 font-body">
            <button type="button"
                class="text-secondary max-w-sm bg-gray-200 font-medium font-body rounded-xl text-md items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90 flex justify-between"
                style="background-color: #00B5FF">
                <h5 class="mb-2 text-lg font-bold tracking-tight text-header">Total Anggota</h5>
                <p class="font-medium text-xl text-white">
                    <?php echo totalAnggota($conn) ?>
                </p>
            </button>
            <button type="button"
                class="text-secondary max-w-sm bg-gray-200 font-medium font-body rounded-xl text-md items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90 flex justify-between"
                style="background-color: #FFBE00">
                <h5 class="mb-2 text-lg font-bold tracking-tight text-header">Berkas Tersimpan</h5>
                <p class="font-medium text-xl text-white">
                    <?php echo totalBerkas($conn) ?>
                </p>
            </button>
            <button type="button"
                class="text-secondary max-w-sm bg-gray-200 font-medium font-body rounded-xl text-md items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90 flex justify-between"
                style="background-color: #00A96E">
                <h5 class="mb-2 text-lg font-bold tracking-tight text-header">Aspirasi Selesai</h5>
                <p class="font-medium text-xl text-white">
                    <?php echo totalAspirasi($conn) ?>
                </p>
            </button>
            <button type="button"
                class="text-secondary max-w-sm bg-gray-200 font-medium font-body rounded-xl text-md items-center px-5 py-2.5 text-center me-2 transition-all duration-100 ease-in-out transform active:scale-90 flex justify-between"
                style="background-color: #8000FF">
                <h5 class="mb-2 text-lg font-bold tracking-tight text-header">Judul Forum</h5>
                <p class="font-medium text-xl text-white">
                    <?php echo totalForum($conn) ?>
                </p>
            </button>
        </div>
        <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4 font-body">
            <div class="p-3 mt-3">
                <h3 class="text-lg text-center font-header text-header font-bold">Jumlah berkas yang dikirim oleh
                    kementerian</h3>
                <canvas id="myChart"></canvas>
            </div>
            <div class="">
                <div class="mt-8 mb-4">
                    <div class="flex justify-center">
                        <img class=" w-20 h-20 p-1 rounded-full ring-2 ring-gray-300"
                            src="../assets/profile/<?php echo profile($conn)['foto'] ?>" alt="">
                    </div>
                    <div class="flex justify-center">
                        <div class="font-bold font-body tracking-wider text-md text-header my-2">
                            <?php echo profile($conn)['nama'] ?>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="text-md text-secondary mb-2">
                            <?php echo profile($conn)['nim'] ?>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="text-md text-secondary mb-2">
                            <?php echo profile($conn)['kementerian'] ?>
                        </div>
                    </div>
                </div>
                <div class="flex mt-2 justify-center">
                    <a href="../profile/profile.php"
                        class="focus:outline-none flex items-center text-white font-medium rounded-full text-md font-body px-4 py-2 me-2 mb-2 transition-all duration-300 ease-in-out transform active:scale-90"
                        style="background-color: #291334;">
                        Ubah Profil Anggota
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            class="humbleicons hi-arrow-right h-6 w-6 ms-4">
                            <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M4 12h16m0 0l-6 6m6-6l-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="row my-10"><br></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($kementerian) ?>,
                datasets: [{
                    label: 'Total berkas',
                    data: <?php echo json_encode($jumlahBerkas) ?>,
                    borderWidth: 1,
                    borderRadius: Number.MAX_VALUE
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    </script>
</section>
<?php
// mengimpor file bagian footer
include '../templates/footer.php';
?>