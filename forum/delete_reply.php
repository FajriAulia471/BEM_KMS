<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/logout.php");
    exit;
}
require '../function/functions.php';
$id_reply = $_GET["id_reply"];
$id_topik = $_GET['id_topik'];
$reply = query("SELECT * FROM reply WHERE id_reply = $id_reply")[0];
if (hapusReply($id_reply) > 0) {
    $_SESSION["delete"] = "Komentar berhasil dihapus!";
    header("Location: topic.php?id_topik=$id_topik");
    exit();
} else {
    $_SESSION["error"] = "Komentar gagal dihapus!";
    header("Location: topic.php?id_topik=$id_topik");
    exit();
}
?>