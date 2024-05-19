<?php
session_start();
if ($_SESSION['login']['kementerian'] != 'KOMINFO' && $_SESSION['login']['kementerian'] != 'ADVOKASI') {
    // Kembali ke halaman login
    header("Location: ../auth/logout.php");
    exit;
}
require '../function/functions.php';
$id_aspirasi = $_GET["id_aspirasi"];
if (hapusAspirasi($id_aspirasi) > 0) {
    $_SESSION["delete"] = "Aspirasi berhasil dihapus!";
    header("Location: aspirasi.php");
    exit();
} else {
    $_SESSION["error"] = "Aspirasi gagal dihapus!";
    header("Location: aspirasi.php");
    exit();
}
?>