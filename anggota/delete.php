<?php
// cek session
session_start();
// Mengecek jika session user kosong
if ($_SESSION['login']['kementerian'] != 'KOMINFO') {
    // Kembali ke halaman login
    header("Location: ../auth/logout.php");
    exit;
}
require '../function/functions.php';
$id_anggota = $_GET["id_anggota"];

if (hapusAnggota($id_anggota) > 0) {
    $_SESSION["delete"] = "Data berhasil dihapus!";
    header("Location: anggota.php");
    exit();
} else {
    $_SESSION["error"] = "Data gagal dihapus!";
    header("Location: anggota.php");
    exit();
}
?>