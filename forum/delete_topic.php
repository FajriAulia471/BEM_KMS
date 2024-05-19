<?php
// cek session
session_start();
// Mengecek jika session user kosong
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/logout.php");
    exit;
}
require '../function/functions.php';
$id_topik = $_GET["id_topik"];
if (hapusTopik($id_topik) > 0) {
    $_SESSION["delete"] = "Topik berhasil dihapus!";
    header("Location: forum.php");
    exit();
} else {
    $_SESSION["error"] = "Topik gagal dihapus!";
    header("Location: forum.php");
    exit();
}
?>