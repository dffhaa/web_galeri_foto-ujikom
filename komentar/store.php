<?php
require "../koneksi.php";


$foto = $_GET['foto_id'];
$fotoid = $_POST['fotoid'];
$userid = $_POST['userid'];
$koment = $_POST['koment'];
$tanggal = $_POST['tanggal'];

if (!empty($koment)) {
    $sql = "INSERT INTO tb_komentarfoto(foto_id,user_id,isi_komentar,tanggal_komentar)
            VALUES ('$fotoid','$userid','$koment','$tanggal')";

    $result = $conn->query($sql);
    if (!$result) {
        die("ada kesalahan " . $conn->error);
    }

    header("Location: ../view.php?foto_id=" . urlencode($foto));
}else {
    header("Location: ../view.php?foto_id=" . urlencode($foto) . "&notif=komentar_tidak_boleh_kosong");
    exit();
}
