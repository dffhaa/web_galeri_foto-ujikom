<?php

require "../koneksi.php";

$id = $_POST['albumid'];
$nama = $_POST['namaalbum'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];
$iduser = $_POST['user_id'];

$sql = "UPDATE tb_album SET nama_album = '$nama', deskripsi_album = '$deskripsi', tanggal_dibuat = '$tanggal' WHERE album_id = '$id'";

$result = $conn->query($sql);
if(!$result){
    die ("Ada kesalhan : " .$conn->error);
}
if($conn->affected_rows){
    header("location:../album/album.php");
}

?>