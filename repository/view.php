<?php
// cek session
session_start();
// Mengecek jika session user kosong
if (!isset($_SESSION["login"])) {
    header("Location: ../auth/logout.php");
    exit;
}

include '../function/functions.php';

$id_repository = isset($_GET['id_repository']) ? $_GET['id_repository'] : null;

if (!$id_repository) {
    echo "Data tidak ditemukan!";
    exit();
}

$view = query("SELECT * FROM repository WHERE id_repository=$id_repository")[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="padding: 0; margin: 0;">
    <iframe src="../assets/files/<?php echo $view['berkas'] ?>" type='application/pdf' frameborder="0" width="100%"
        height="700" style="display: block;"></iframe>
</body>

</html>