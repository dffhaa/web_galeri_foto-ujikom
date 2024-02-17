<?php

session_start();
require "../koneksi.php";

$fotoid = $_GET['foto_id'];
$userid = $_SESSION['user_id'];

$ceksuka = mysqli_query($conn, "SELECT * FROM tb_likefoto WHERE foto_id = '$fotoid' AND user_id='$userid'");

if(mysqli_num_rows($ceksuka)==1){
    while($row= mysqli_fetch_array($ceksuka)){
        $likeid = $row['like_id'];
        $query = mysqli_query($conn, "DELETE FROM tb_likefoto WHERE like_id='$likeid'");
        header("Location: ../view.php?foto_id=" . urlencode($fotoid));
        //</script>";

    }
}else{
    $tanggal = date('Y-m-d');
    $query = mysqli_query($conn,"INSERT INTO tb_likefoto (foto_id,user_id,tanggal_like) VALUES('$fotoid','$userid','$tanggal') ");
    header("Location: ../view.php?foto_id=" . urlencode($fotoid));

}
?>
