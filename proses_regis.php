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

    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query1 = $conn->query("SELECT * FROM tb_user
                            WHERE username = '$username' AND password = '$password'");


    if(mysqli_num_rows($query1) > 0 ){
        $result1 = $query1->fetch_object();

        $_SESSION['login'] = 'sukses';
        $_SESSION['username'] = $result1->username;
        $_SESSION['user_id'] = $result1->user_id;
        $_SESSION['nama_lengkap'] = $result1->nama_lengkap;
        $_SESSION['email'] = $result1->email;

        ?>
        <script>
            window.alert('regis Berhasil !');
            window.location.href='login.php';
        </script>

        <?php
    }



?>