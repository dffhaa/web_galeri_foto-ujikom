<?php

require "../../koneksi.php";

$album = $_GET['album_id'];
$nama = $_GET['nama_album'];
$judul = $_POST['judulfoto'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];
$albumid = $_POST['album'];
$iduser = $_POST['user_id'];

//gambar store
$picture = $_FILES['lokasi_file']['name'];
$target_path = "../../img/";
move_uploaded_file($_FILES['lokasi_file']['tmp_name'], $target_path . $picture);

$sql = "INSERT INTO tb_foto(judul_foto,deskripsi_foto,tanggal_unggah,lokasi_file,album_id,user_id) 
    VALUES('$judul','$deskripsi','$tanggal','$picture','$albumid','$iduser')";

$result = $conn->query($sql);
if(!$result){
    die ("Ada kesalhan : " .$conn->error);
}
if($conn->affected_rows){
    header("location:../view/view.php?album_id=" . urlencode($album) . "&nama_album=" . urldecode($nama));
}


?>
