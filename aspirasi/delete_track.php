<?php
session_start();
if ($_SESSION['login']['kementerian'] != 'KOMINFO' && $_SESSION['login']['kementerian'] != 'ADVOKASI') {
    // Kembali ke halaman login
    header("Location: ../auth/logout.php");
    exit;
}
require '../function/functions.php';
$id_track = $_GET["id_track"];
$track = query("SELECT * FROM tracking WHERE id_track=$id_track")[0];
if (hapusTrack($id_track) > 0) {
    $_SESSION["success"] = "Progress berhasil dihapus!";
    header("Location: track.php?id_aspirasi=" . $track['id_aspirasi']);
    exit();
} else {
    $_SESSION["error"] = "Progress gagal dihapus!";
    header("Location: track.php?id_aspirasi=" . $track['id_aspirasi']);
    exit();
}
?>