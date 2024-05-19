<?php
// cek session
session_start();
// Mengecek jika session user kosong
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/logout.php");
    exit;
}
include ("../connection/connection.php");

if (isset($_GET["file"])) {
    $fileName = basename($_GET["file"]);
    $filePath = "../assets/files/" . $fileName;

    if (file_exists($filePath)) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=" . $fileName);
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>