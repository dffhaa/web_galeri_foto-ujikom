<?php

    require "koneksi.php";

    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $email = strip_tags($_POST['email']);
    $namalengkap= strip_tags($_POST['namalengkap']);
    $alamat = strip_tags($_POST['alamat']);

    


    $sql = "INSERT INTO tb_user(username, password, email, nama_lengkap, alamat) VALUES('$username','$password','$email','$namalengkap','$alamat')";

    $result = $conn->query($sql);

    if(!$result){
        die("Ada Kesalahan Query : ".$conn->error);
    }

    ?>

        <script>
            window.alert('regis Berhasil !');
            window.location.href='login.php';
        </script>

        
