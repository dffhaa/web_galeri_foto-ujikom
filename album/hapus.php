<?php

require "../koneksi.php";

$id = $_POST['album_id'];


$sql = "DELETE FROM tb_album WHERE album_id = '$id' ";

$result = $conn->query($sql);
if(!$result){
    die ("Ada kesalhan : " .$conn->error);
}
if($conn->affected_rows){
    header("location:../album/album.php");
}

?>