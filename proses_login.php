<?php

    include ('koneksi.php');

    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM tb_user
                            WHERE username = '$username' AND password = '$password'");

    if(mysqli_num_rows($query) > 0 ){
        $result = $query->fetch_object();

        $_SESSION['login'] = 'sukses';
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $result->user_id;
        $_SESSION['nama_lengkap'] = $result1->nama_lengkap;
        $_SESSION['email'] = $result1->email;

        ?>
        <script>
            window.alert('Login Berhasil !');
            window.location.href='index.php';
        </script>

        <?php
    }else{

        ?>
        <script>
            window.alert('Akun Salah. Silahkan Login Kembali!');
            window.Location.href='login.php';
            </script>
        <?php
    }
