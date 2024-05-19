<?php
// cek session
session_start();
// Mengecek jika session user kosong
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/logout.php");
    exit;
}
require '../function/functions.php';
$id_komentar = $_GET["id_komentar"];
$komentar = query("SELECT * FROM komentar WHERE id_komentar = $id_komentar")[0];
$id_topik = $komentar['id_topik'];
if (hapusKomentar($id_komentar) > 0) {
    $_SESSION["delete"] = "Komentar berhasil dihapus!";
    header("Location: topic.php?id_topik=$id_topik");
    exit();
} else {
    $_SESSION["error"] = "Komentar gagal dihapus!";
    header("Location: topic.php?id_topik=$id_topik");
    exit();
}
?>