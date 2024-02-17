<?php

require "../../koneksi.php";

$album = $_GET['album_id'];
$nama = $_GET['nama_album'];
$id = $_POST['foto_id'];


$sql = "DELETE FROM tb_foto WHERE foto_id='$id'";

$result = $conn->query($sql);
if(!$result){
    die ("Ada kesalhan : " .$conn->error);
}
if($conn->affected_rows){
    header("location:../view/view.php?album_id=" . urlencode($album) . "&nama_album=" . urldecode($nama));
}


?>
