<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id_anggota', '', time() - 864000, "/");
setcookie('key', '', time() - 864000, "/");

header("Location: ../auth/login.php");
?>