<?php

require "../../koneksi.php";

$album = $_GET['album_id'];
$nama = $_GET['nama_album'];
$id = $_POST['fotoid'];
$judul = $_POST['judulfoto'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];


//gambar store
$picture = $_FILES['lokasi_file']['name'];
$target_path = "../../img/";
move_uploaded_file($_FILES['lokasi_file']['tmp_name'], $target_path . $picture);

$sql = "UPDATE tb_foto SET judul_foto = '$judul',deskripsi_foto = '$deskripsi',tanggal_unggah = '$tanggal', lokasi_file='$picture' WHERE foto_id = '$id'";

$result = $conn->query($sql);
if(!$result){
    die ("Ada kesalhan : " .$conn->error);
}
if($conn->affected_rows){
    header("location:../view/view.php?album_id=" . urlencode($album) . "&nama_album=" . urldecode($nama));
}


?>
