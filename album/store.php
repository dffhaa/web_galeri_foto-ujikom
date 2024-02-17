<?php

require "../koneksi.php";

$id = $_POST['albumid'];
$nama = $_POST['namaalbum'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];
$iduser = $_POST['user_id'];

$sql = "INSERT INTO tb_album(album_id,nama_album,deskripsi_album,tanggal_dibuat,user_id) 
    VALUES('$id','$nama','$deskripsi','$tanggal','$iduser')";

$result = $conn->query($sql);
if(!$result){
    die ("Ada kesalhan : " .$conn->error);
}
if($conn->affected_rows){
    header("location:../album/album.php");
}

?>