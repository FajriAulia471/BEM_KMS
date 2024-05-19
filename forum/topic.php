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

$id_topik = $_GET["id_topik"];

$_menuAktif = 'forum';

if (isset($_POST["submit"])) {
    tambahKomentar($_POST['id_topik'], $_POST);
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
            <a href="./forum.php"><svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24"
                    class="humbleicons hi-arrow-left w-8 h-8 transition-all duration-300 ease-in-out transform active:scale-90"
                    style="color: #291334;">
                    <path xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6" />
                </svg></a>
            <!-- Center-aligned heading -->
            <h1 class="flex-grow text-header font-bold text-xl justify-end ms-3">Topik diskusi</h1>
        </div>

        <?php
        if ($id_topik) {
            $result = query("SELECT topik.*, anggota.nama, anggota.nim, anggota.foto FROM topik INNER JOIN anggota ON topik.id_user=anggota.id_anggota WHERE topik.id_topik=$id_topik");
            if ($result) {
                $data = $result[0]; ?>

                <div class="mt-5 flex items-center">
                    <img class="w-14 h-14 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                        src="../assets/profile/<?php echo ($data['foto']) ?>" alt="Bordered avatar">
                    <div class="flex-grow ms-4 font-body text-md text-header">
                        <h3>
                            <?php echo ($data['nama']); ?>
                        </h3>
                        <h3>
                            <?php echo date('d M Y H:i', strtotime($data['tanggal'])); ?>
                        </h3>
                    </div>
                </div>
                <div class="row mt-5 mb-5">
                    <h1 class="font-body text-lg text-header font-bold">
                        <?php echo htmlentities($data['judul']); ?>
                    </h1>
                    <H3 class="font-body text-md text-header">
                        <?php echo nl2br(htmlentities($data['deskripsi'])); ?>
                    </H3>
                </div>
                <hr>
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
                $result = query("SELECT komentar.*, anggota.nama, anggota.nim, anggota.foto AS anggota_foto FROM komentar INNER JOIN anggota ON anggota.id_anggota = komentar.id_user WHERE id_topik=$id_topik");
                foreach ($result as $komentar): ?>
                    <?php
                    include '../forum/komentar.php';
                    ?>
                <?php endforeach; ?>

                <?php
                include '../forum/form.php';
                ?>

            <?php } else { ?>
                <h3 class="text-header font-bold text-xl text-center mt-1 mb-4">
                    Data tidak ditemukan
                </h3>
            <?php } ?>
        <?php } else { ?>
            <h3 clas s="text-header font-bold text-xl text-center mt-1 mb-4">
                Data tidak ditemukan
            </h3>
        <?php } ?>
    </div>
    <div class="mt-10 mb-10">
        <br>
        <br>
    </div>
</section>
<script>
    // Mengambil elemen input dan button hapus
    const replyInput = document.getElementById('reply');
    const clearButton = document.getElementById('clear-button');

    // menambahkan click event listener untuk button hapus
    clearButton.addEventListener('click', function () {

        // Menghapus isi input elemen
        replyInput.value = '';
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // untuk button form
        var replyButtons = document.querySelectorAll(".reply");
        var replyReplyButtons = document.querySelectorAll(".reply-reply");
        // kelola form
        var replyForm = document.getElementById("reply-form");
        var komentarForm = document.getElementById("komentar-form");
        var replyReplyForm = document.getElementById("replyReply-form");
        // ambil hasil db
        var idNamaKomentarInput = document.getElementById("nama");
        var idKomentarInput = document.getElementById("id_komentar");
        var idNamaReplyInput = document.getElementById("namaa");
        var idKomentarReplyInput = document.getElementById("parent_id_reply");
        // ngebalikin form
        var clearButton = document.getElementById("clear-button");
        var clearReplyButton = document.getElementById("clear-reply-button");

        replyButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                var nama = button.getAttribute("data-nama");
                var id_komentar = button.getAttribute("data-komentar");

                idNamaKomentarInput.value = nama;
                idKomentarInput.value = id_komentar;

                replyForm.classList.remove("hidden");
                replyForm.scrollIntoView({ behavior: "smooth" });
                komentarForm.classList.add("hidden");
                replyReplyForm.classList.add("hidden");
            });
        });

        replyReplyButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                var namaa = button.getAttribute("data-nama-reply");
                var parent_id_reply = button.getAttribute("data-reply");

                idNamaReplyInput.value = namaa;
                idKomentarReplyInput.value = parent_id_reply;

                replyReplyForm.classList.remove("hidden");
                replyReplyForm.scrollIntoView({ behavior: "smooth" });
                komentarForm.classList.add("hidden");
                replyForm.classList.add("hidden");
            });
        });

        clearButton.addEventListener("click", function () {
            replyForm.classList.add("hidden");
            komentarForm.classList.remove("hidden");
        });

        clearReplyButton.addEventListener("click", function () {
            replyReplyForm.classList.add("hidden");
            komentarForm.classList.remove("hidden");
        });
    });
</script>
<?php
include '../templates/footer.php';
?>