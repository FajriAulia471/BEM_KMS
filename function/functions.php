<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "kms");

include "./config.php";

function query($query)
{
    global $conn;
    // ambil data dari tabel yang ada di db wpu
    $result = mysqli_query($conn, $query);
    $data = [];
    // ambil data (fetch) mahasiswa dari objek result
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// ---------- ANGGOTA :START ----------
function tambahAnggota($data)
{
    session_start();
    global $conn;

    $nim = mysqli_real_escape_string($conn, $data["nim"]);

    $result = mysqli_query($conn, "SELECT nim FROM anggota WHERE nim='$nim'");

    if (mysqli_fetch_assoc($result)) {
        $_SESSION["error"] = "NIM sudah ada!";
        header("Location: ../anggota/add.php");
        exit();
    }

    $nama = mysqli_real_escape_string($conn, $data["nama"]);

    // upload gambar
    $foto = uploadFoto();

    if (!$foto) {
        return false;
    }

    $kementerian = mysqli_real_escape_string($conn, $data["kementerian"]);
    $password = mysqli_real_escape_string($conn, $data['password']);

    $password = password_hash($password, PASSWORD_DEFAULT);

    // query insert data
    $query = "INSERT INTO anggota (nim, nama, foto, kementerian, password) VALUES ('$nim', '$nama', '$foto', '$kementerian', '$password')";

    if (mysqli_query($conn, $query)) {
        $_SESSION["success"] = "Data berhasil ditambahkan!";
        header("Location: ../anggota/add.php");
        exit();
    }
}

function uploadFoto()
{

    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // stringnya dipecah menjadi array menggunakan fungsi explode
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION["error"] = "Hanya boleh gambar!";
        header("Location: ../anggota/add.php");
        exit;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, "../assets/profile/" . $namaFileBaru);

    return $namaFileBaru;
}

function ubahAnggota($id_anggota, $data)
{
    global $conn;

    // ambil data dari tiap element dalam form
    $nim = mysqli_real_escape_string($conn, $data["nim"]);
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $fotoLama = mysqli_real_escape_string($conn, $data["fotoLama"]);
    $kementerian = mysqli_real_escape_string($conn, $data["kementerian"]);

    $result = mysqli_query($conn, "SELECT * FROM anggota WHERE nim = '$nim' AND id_anggota != '$id_anggota'");

    if (mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION["error"] = "NIM sudah ada!";
        header("Location: ../anggota/edit.php?id_anggota=$id_anggota");
        exit();
    } else {
        if ($_FILES['foto']['error'] === 4) {
            $foto = $fotoLama;
        } else {
            $foto = updateFoto($id_anggota);
        }

        // query ubah data
        $query = "UPDATE anggota SET nim='$nim', nama='$nama', foto='$foto', kementerian='$kementerian' WHERE id_anggota=$id_anggota";

        if (mysqli_query($conn, $query)) {
            $_SESSION["login"] = [
                'id_anggota' => $id_anggota,
                'nim' => $_SESSION["login"]['nim'],
                'nama' => $_SESSION["login"]['nama'],
                'kementerian' => $kementerian
            ];
            $_SESSION["update"] = "Data berhasil diubah!";
            header("Location: ../anggota/anggota.php");
            exit();
        }
    }
}


function updateFoto($id_anggota)
{

    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // stringnya dipecah menjadi array menggunakan fungsi explode
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION["error"] = "Hanya boleh gambar!";
        header("Location: ../anggota/edit.php?id_anggota=$id_anggota");
        exit;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, "../assets/img/" . $namaFileBaru);

    return $namaFileBaru;
}

function ubahPassword($data)
{
    global $conn;

    // ambil data dari tiap element dalam form
    $id_anggota = ($data["id_anggota"]);
    $password_baru = mysqli_real_escape_string($conn, $data["password_baru"]);
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);

    // cek konfirmasi password
    if ($password_baru !== $konfirmasi_password) {
        session_start();
        $_SESSION["error"] = "Password Tidak Sama!";
        header("Location: ../anggota/auth.php?id_anggota=$id_anggota");
        exit();
    }

    // enkripsi password
    $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);


    // query ubah data
    $query = "UPDATE anggota SET password='$password_baru' WHERE id_anggota=$id_anggota";

    if (mysqli_query($conn, $query)) {
        $_SESSION["update"] = "Data berhasil diubah!";
        header("Location: ../anggota/anggota.php");
        exit();
    }

}

function hapusAnggota($id_anggota)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM anggota WHERE id_anggota=$id_anggota");

    return mysqli_affected_rows($conn);
}

// ---------- ANGGOTA :END ----------

// ---------- REPOSITORY :START ----------
function tambahRepository($data)
{
    session_start();
    global $conn;

    $kementerian = mysqli_real_escape_string($conn, $data["kementerian"]);
    $kategori = mysqli_real_escape_string($conn, $data["kategori"]);
    $keterangan = mysqli_real_escape_string($conn, $data["keterangan"]);
    $nama_berkas = $_FILES['berkas']['name'];

    // upload gambar
    $berkas = uploadBerkas();

    if (!$berkas) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO repository (kementerian, kategori, keterangan, berkas, nama_berkas) VALUES ('$kementerian', '$kategori', '$keterangan', '$berkas', '$nama_berkas')";

    if (mysqli_query($conn, $query)) {
        $_SESSION["success"] = "Data berhasil ditambahkan!";
        header("Location: ../repository/add.php");
        exit();
    }
}

function uploadBerkas()
{

    $namaFile = $_FILES['berkas']['name'];
    $tmpName = $_FILES['berkas']['tmp_name'];

    $ekstensiDokumenValid = ['pdf'];
    $ekstensiDokumen = explode('.', $namaFile);
    $ekstensiDokumen = strtolower(end($ekstensiDokumen));
    if (!in_array($ekstensiDokumen, $ekstensiDokumenValid)) {
        $_SESSION["error"] = "Hanya boleh PDF!";
        header("Location: ../repository/add.php");
        exit;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiDokumen;
    move_uploaded_file($tmpName, "../assets/files/" . $namaFileBaru);

    return $namaFileBaru;
}

function ubahRepository($id_repository, $data)
{
    global $conn;

    // ambil data dari tiap element dalam form
    $id_repository = ($data["id_repository"]);
    $kementerian = mysqli_real_escape_string($conn, $data["kementerian"]);
    $kategori = mysqli_real_escape_string($conn, $data["kategori"]);
    $keterangan = mysqli_real_escape_string($conn, $data["keterangan"]);
    $berkasLama = mysqli_real_escape_string($conn, $data["berkasLama"]);

    // Check if new file is uploaded
    if ($_FILES['berkas']['error'] === 4) { // 4 means no file uploaded
        $berkas = $berkasLama; // Use the old file name
    } else {
        $berkas = ubahBerkas($id_repository); // Upload and get new file name
    }

    // query ubah data
    $query = "UPDATE repository SET kementerian='$kementerian', kategori='$kategori',keterangan='$keterangan', berkas='$berkas' WHERE id_repository=$id_repository";

    if (mysqli_query($conn, $query)) {
        $_SESSION["update"] = "Data berhasil diubah!";
        header("Location: ../repository/repository.php");
        exit();
    }
}

function ubahBerkas($id_repository)
{

    $namaFile = $_FILES['berkas']['name'];
    $tmpName = $_FILES['berkas']['tmp_name'];

    $ekstensiDokumenValid = ['pdf'];
    $ekstensiDokumen = explode('.', $namaFile);
    $ekstensiDokumen = strtolower(end($ekstensiDokumen));

    if (!in_array($ekstensiDokumen, $ekstensiDokumenValid)) {
        $_SESSION["error"] = "Hanya boleh PDF!";
        header("Location: ../repository/edit.php?id_repository=$id_repository");
        exit;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiDokumen;
    move_uploaded_file($tmpName, "../assets/files/" . $namaFileBaru);

    return $namaFileBaru;
}

function hapusRepository($id_repository)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM repository WHERE id_repository=$id_repository");

    return mysqli_affected_rows($conn);
}
// ---------- REPOSITORY :END ----------

// ---------- ASPIRASI :START ----------
function tambahAspirasi($data)
{
    session_start();
    global $conn;

    $aspirasi = mysqli_real_escape_string($conn, $data["aspirasi"]);
    $deskripsi = mysqli_real_escape_string($conn, $data["deskripsi"]);

    // query insert data
    $query = "INSERT INTO aspirasi (aspirasi, deskripsi, tanggal) VALUES ('$aspirasi', '$deskripsi', now())";

    if (mysqli_query($conn, $query)) {
        $_SESSION["success"] = "Aspirasi berhasil ditambahkan!";
        header("Location: ../aspirasi/aspirasi.php");
        exit();
    }
}

function ubahAspirasi($data)
{
    global $conn;

    // ambil data dari tiap element dalam form
    $id_aspirasi = ($data["id_aspirasi"]);
    $aspirasi = mysqli_real_escape_string($conn, $data["aspirasi"]);
    $deskripsi = mysqli_real_escape_string($conn, $data["deskripsi"]);

    // query ubah data
    $query = "UPDATE aspirasi SET aspirasi = '$aspirasi', deskripsi = '$deskripsi', tanggal = now() WHERE id_aspirasi = '$id_aspirasi'";

    if (mysqli_query($conn, $query)) {
        $_SESSION["update"] = "Aspirasi berhasil diubah!";
        header("Location: ../aspirasi/aspirasi.php");
        exit();
    }
}

function hapusAspirasi($id_aspirasi)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM aspirasi WHERE id_aspirasi=$id_aspirasi");

    return mysqli_affected_rows($conn);
}
// ---------- ASPIRASI :END ----------

// ---------- TRACKING :START ----------
function tambahTrack($id_aspirasi, $data)
{
    global $conn;

    $proses = mysqli_real_escape_string($conn, $data["proses"]);

    // upload gambar
    $foto = uploadBukti($id_aspirasi);

    if (!$foto) {
        return false;
    }

    $status = mysqli_real_escape_string($conn, $data["status"]);
    $tanggal = mysqli_real_escape_string($conn, $data["tanggal"]);
    $id_aspirasi = mysqli_real_escape_string($conn, $data["id_aspirasi"]);

    // query insert data
    $query = "INSERT INTO tracking (proses, foto, status, tanggal, id_aspirasi) VALUES ('$proses', '$foto', '$status', '$tanggal', '$id_aspirasi')";

    if (mysqli_query($conn, $query)) {
        $_SESSION["success"] = "Data berhasil ditambahkan!";
        header("Location: ../aspirasi/track.php?id_aspirasi=$id_aspirasi");
        exit();
    }
}

function uploadBukti($id_aspirasi)
{

    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // stringnya dipecah menjadi array menggunakan fungsi explode
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION["error"] = "Hanya boleh gambar!";
        header("Location: ../aspirasi/track.php?id_aspirasi=$id_aspirasi");
        exit;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, "../assets/aspirasi/" . $namaFileBaru);

    return $namaFileBaru;
}

function ubahTrack($id_track, $data)
{
    global $conn;

    // ambil data dari tiap element dalam form
    $proses = mysqli_real_escape_string($conn, $data['proses']);
    $fotoLama = mysqli_real_escape_string($conn, $data['fotoLama']);

    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = ubahBuktiTrack($id_track);
    }

    $status = mysqli_real_escape_string($conn, $data['status']);
    $tanggal = mysqli_real_escape_string($conn, $data['tanggal']);
    $id_track = mysqli_real_escape_string($conn, $data['id_track']);
    $id_aspirasi = mysqli_real_escape_string($conn, $data['id_aspirasi']);

    // query ubah data
    $query = "UPDATE tracking SET proses = '$proses', status = '$status', foto='$foto', tanggal = '$tanggal', id_aspirasi='$id_aspirasi' WHERE id_track = '$id_track'";

    if (mysqli_query($conn, $query)) {
        $_SESSION["update"] = "Data berhasil diubah!";
        header("Location: ../aspirasi/track.php?id_aspirasi=$id_aspirasi");
        exit();
    }
}

function ubahBuktiTrack($id_track)
{

    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION["error"] = "Hanya boleh gambar!";
        header("Location: ../aspirasi/edit_track.php?id_track=$id_track");
        exit;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, "../assets/aspirasi/" . $namaFileBaru);

    return $namaFileBaru;
}

function hapusTrack($id_track)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tracking WHERE id_track=$id_track");

    return mysqli_affected_rows($conn);
}
// ---------- TRACKING :END ----------

// ---------- FORUM :START ----------
function tambahForum($data)
{
    global $conn;

    $judul = mysqli_real_escape_string($conn, $data["judul"]);
    $deskripsi = mysqli_real_escape_string($conn, $data["deskripsi"]);
    $id_user = mysqli_real_escape_string($conn, $_SESSION['login']['id_anggota']);

    // query insert data
    $query = "INSERT INTO topik (judul, deskripsi, tanggal, id_user) VALUES ('$judul', '$deskripsi', now(), '$id_user')";

    if (mysqli_query($conn, $query)) {
        $_SESSION["success"] = "Aspirasi berhasil ditambahkan!";
        header("Location: ../forum/forum.php");
        exit();
    }
}

function ubahForum($data)
{
    global $conn;

    // ambil data dari tiap element dalam form
    $judul = mysqli_real_escape_string($conn, $data["judul"]);
    $deskripsi = mysqli_real_escape_string($conn, $data["deskripsi"]);
    $id_topik = mysqli_real_escape_string($conn, $data["id_topik"]);
    $id_user = mysqli_real_escape_string($conn, $_SESSION['login']['id_anggota']);

    // query ubah data
    $query = "UPDATE topik SET judul = '$judul', deskripsi = '$deskripsi', tanggal = now(), id_user = '$id_user' WHERE id_topik = '$id_topik'";

    if (mysqli_query($conn, $query)) {
        $_SESSION["update"] = "Aspirasi berhasil diubah!";
        header("Location: ../forum/forum.php");
        exit();
    }
}

function hapusTopik($id_topik)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM topik WHERE id_topik=$id_topik");

    return mysqli_affected_rows($conn);
}
// ---------- FORUM :END ----------

// ---------- KOMENTAR :START ----------
function tambahKomentar($id_topik, $data)
{
    global $conn;

    $id_topik = mysqli_real_escape_string($conn, $data["id_topik"]);
    $id_anggota = mysqli_real_escape_string($conn, $_SESSION['login']['id_anggota']);
    $form_type = mysqli_real_escape_string($conn, $data["form_type"]);

    if ($_FILES['foto']['name'] != '') {
        $foto = uploadFotoKomentar($id_topik);
        if (!$foto) {
            return false;
        }
    } else {
        $foto = '';
    }

    if ($form_type == 'reply') {
        $id_komentar = mysqli_real_escape_string($conn, $data["id_komentar"]);
        $reply = mysqli_real_escape_string($conn, $data["reply"]);

        $query = "INSERT INTO reply (reply, foto, tanggal, id_komentar, id_user) VALUES ('$reply', '$foto', NOW(),  '$id_komentar', '$id_anggota')";

        mysqli_query($conn, $query);
        $_SESSION["success"] = "Balasan berhasil ditambahkan!";
        header("Location: ../forum/topic.php?id_topik=$id_topik");
        exit();

    } else if ($form_type == 'reply-reply') {
        $reply = mysqli_real_escape_string($conn, $data["reply"]);
        $parent_id_reply = mysqli_real_escape_string($conn, $data["parent_id_reply"]);

        $query = "INSERT INTO reply (reply, foto, tanggal, id_user, parent_id_reply) VALUES ('$reply', '$foto', NOW(), '$id_anggota', '$parent_id_reply')";

        mysqli_query($conn, $query);
        $_SESSION["success"] = "Balasan berhasil ditambahkan!";
        header("Location: ../forum/topic.php?id_topik=$id_topik");
        exit();

    } else {
        $komentar = mysqli_real_escape_string($conn, $data["komentar"]);

        $query = "INSERT INTO komentar (komentar, foto, tanggal, id_topik, id_user) VALUES ('$komentar', '$foto', NOW(), '$id_topik', '$id_anggota')";

        if (mysqli_query($conn, $query)) {
            $_SESSION["success"] = "Komentar berhasil ditambahkan!";
            header("Location: ../forum/topic.php?id_topik=$id_topik");
            exit();
        }
    }
}

function uploadFotoKomentar($id_topik)
{
    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION["error"] = "Hanya boleh gambar!";
        header("Location: ../forum/topic.php?id_topik=$id_topik");
        exit;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, "../assets/forum/" . $namaFileBaru);

    return $namaFileBaru;
}

function hapusKomentar($id_komentar)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM komentar WHERE id_komentar=$id_komentar and id_user={$_SESSION['login']['id_anggota']}");

    return mysqli_affected_rows($conn);
}
function hapusReply($id_reply)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM reply WHERE id_reply=$id_reply");

    return mysqli_affected_rows($conn);
}
// ---------- KOMENTAR :END ----------

// ---------- PROFILE :START ----------
function ubahProfile($id_anggota, $data)
{
    global $conn;
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $password_baru = mysqli_real_escape_string($conn, $data["password_baru"]);
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);

    if (!empty($password_baru) && !empty($konfirmasi_password)) {
        // cek konfirmasi password
        if ($password_baru !== $konfirmasi_password) {
            session_start();
            $_SESSION["error"] = "Password Tidak Sama!";
            header("Location: ../profile/profile.php");
            exit();
        }
        // enkripsi password
        $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

        $query = "UPDATE anggota SET password = '$password_baru' WHERE id_anggota={$_SESSION['login']['id_anggota']}";

        if (mysqli_query($conn, $query)) {
            $_SESSION["success"] = "Password berhasil diubah!";
            header("Location: ../profile/profile.php");
            exit();
        }
    }

    // query ubah data
    $query = "UPDATE anggota SET nama='$nama' WHERE id_anggota={$_SESSION['login']['id_anggota']}";

    if (mysqli_query($conn, $query)) {
        $_SESSION["success"] = "Data berhasil diubah!";
        header("Location: ../profile/profile.php");
        exit();
    }

}
// ---------- PROFILE :END ----------

// ---------- DASHBOARD :START ----------
function totalAnggota($conn)
{
    $sqlCount = "SELECT COUNT(*) AS total_anggota FROM anggota";
    $countResult = mysqli_query($conn, $sqlCount);
    $totalAnggota = mysqli_fetch_assoc($countResult)['total_anggota'];
    return $totalAnggota;
}

function totalBerkas($conn)
{
    $sqlCount = "SELECT COUNT(*) AS total_berkas FROM repository";
    $countResult = mysqli_query($conn, $sqlCount);
    $totalBerkas = mysqli_fetch_assoc($countResult)['total_berkas'];
    return $totalBerkas;
}

function totalAspirasi($conn)
{
    $sqlCount = "SELECT COUNT(*) AS total_aspirasi FROM tracking WHERE status='SELESAI'";
    $countResult = mysqli_query($conn, $sqlCount);
    $totalAspirasi = mysqli_fetch_assoc($countResult)['total_aspirasi'];
    return $totalAspirasi;
}

function totalForum($conn)
{
    $sqlCount = "SELECT COUNT(*) AS total_forum FROM topik";
    $countResult = mysqli_query($conn, $sqlCount);
    $totalForum = mysqli_fetch_assoc($countResult)['total_forum'];
    return $totalForum;
}
// ---------- DASHBOARD :END ----------
?>