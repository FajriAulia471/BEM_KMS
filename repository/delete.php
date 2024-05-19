<?php
// cek session
session_start();
// Mengecek jika session user kosong
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/logout.php");
    exit;
}

require '../function/functions.php';
$id_repository = $_GET["id_repository"];

if (hapusRepository($id_repository) > 0) {
    $_SESSION["delete"] = "Data berhasil dihapus!";
    header("Location: repository.php");
    exit();
} else {
    $_SESSION["error"] = "Data gagal dihapus!";
    header("Location: repository.php");
    exit();
}
?>