<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    session_start();
    require "koneksi.php";
    if (!isset($_SESSION['username'])) {
        header("location:login.php");
    }
    $fotoid = $_GET['foto_id'];

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pinterest</title>
    <link rel="icon" href="img/pinterest-logo-icon-social-media-icon-free.png">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" style type="text/css" href="bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <style>
        #itemmenu ul li a:hover {
            color: #BFA73E;
            font-weight: bold;
        }

        .comment-section {
            margin-top: 12px;
        }

        .comment-list {
            list-style: none;
            padding: 0;
        }

        .comment {
            border-bottom: 1px solid #ddd;
            padding: 8px 0;
        }

        .comment-form {
            margin-top: 12px;
        }

        .like-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">

                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(img/2.jpg);"></a>



                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="album/album.php">Album</a>
                    </li>


                </ul>

                <div class="footer">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>


                    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#itemmenu" aria-control="itemmenu" aria-expanded="false" aria-label="Buka Menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div id="itemmenu" class="collapse navbar-collapse justify-content-end" style="margin-right:70px; font-size: 15px;">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="hover-effect nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="hover-effect nav-link" href="album/album.php">Album</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="logout.php" class="btn btn-primary"><i class="bi bi-box-arrow-right"> Logout</i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>



            <p>
            <h1 class="">Selamat Datang <?php echo $_SESSION['username']; ?> di Pinterest</h1>

            <div class="mt-5">
                <span class="h3">Foto Terbaru</span>
                <a class="btn btn-primary btn-sm float-end" href="index.php">

                    Kembali
                </a>

                <div class="pin-container">
                    <?php
                    $sql_foto = "SELECT * FROM tb_foto WHERE foto_id = '$fotoid'"; // Ganti 'your_photo_id' dengan foto_id yang diinginkan
                    $result_foto = $conn->query($sql_foto);

                    if ($result_foto->num_rows > 0) {
                        while ($row_foto = $result_foto->fetch_assoc()) {
                    ?>
                            <!-- Pin -->
                            <div class="pin">
                                <div class="card mb-3" style="max-width: 1550px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="img/<?php echo $row_foto['lokasi_file']; ?>" class="img-fluid img-thumbnail rounded-start" alt="Image <?php echo $row_foto['foto_id']; ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h1 class="h1"><?php echo $row_foto['judul_foto']; ?></h1>
                                                <p class="card-text h4"><?php echo $row_foto['deskripsi_foto']; ?></p>
                                                <p class="card-text"><small class="text-muted h6">Last updated <?php echo $row_foto['tanggal_unggah']; ?></small></p>

                                                <ul class="comment-list">
                                                    <?php
                                                    // Query untuk mengambil komentar terkait dengan foto
                                                    $sql_komentar = "SELECT  komentar_id, isi_komentar, tanggal_komentar, tb_user.username FROM tb_komentarfoto JOIN tb_user ON tb_komentarfoto.user_id=tb_user.user_id WHERE foto_id = '" . $row_foto['foto_id'] . "'";
                                                    $result_komentar = $conn->query($sql_komentar);

                                                    if ($result_komentar->num_rows > 0) {
                                                        while ($row_komentar = $result_komentar->fetch_assoc()) {
                                                    ?>
                                                            <li class="coment nav-item dropdown">
                                                                <a class="comment nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <?php echo $row_komentar['isi_komentar']; ?> 
                                                                </a>
                                                                <ul class="dropdown-menu">

                                                                    <li>
                                                                        <form action="komentar/hapus.php" method="post">
                                                                            <input type="hidden" class="form-control" name="fotoid" id="fotoid" value="<?php echo $fotoid ?>">
                                                                            <input type="hidden" class="form-control" name="komentar_id" id="komentar_id" value="<?php echo $row_komentar['komentar_id'] ?>">
                                                                            <input type="submit" class="dropdown-item btn btn-primary" value="Hapuss">

                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li class="comment1 "><?php echo $row_komentar['username']; ?></li>
                                                            <li style="margin-top: -20px;" class="comment1 float-end"><?php echo date('d-m-Y', strtotime($row_komentar['tanggal_komentar'])); ?></li>

                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<li>No comments</li>";
                                                    }
                                                    ?>
                                                    <br>
                                                    <li class="comment1">
                                                        <label for="commentInput" class="form-label">Add a Comment:</label>
                                                    </li>
                                                </ul>

                                                <div style="margin-top: -20px;">




                                                    <form action="komentar/store.php" method="post">
                                                        <input type="text" class="form-control float-start w-75" id="koment" name="koment" placeholder="Your comment...">
                                                        <div class="btn-group float-end mb-3" role="group" aria-label="Basic example">
                                                            <input type="hidden" class="form-control" name="fotoid" id="fotoid" value="<?php echo $fotoid ?>">
                                                            <input type="hidden" class="form-control" name="userid" id="userid" value="<?php echo $_SESSION['user_id'] ?>">
                                                            <input type="hidden" class="form-control" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d'); ?>">

                                                            <button type="submit" class="btn btn-primary ms-2"><i class="material-icons" style="font-size:15px">send</i></button>
                                                    </form>
                                                    <?php
                                                    $user = $_SESSION['user_id'];
                                                    $like = mysqli_query($conn, "SELECT * FROM tb_likefoto WHERE foto_id='$fotoid'");

                                                    $ceksuka = mysqli_query($conn, "SELECT * FROM tb_likefoto WHERE foto_id = '$fotoid' AND user_id='$user'");

                                                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                                                        <a href="like/store.php?foto_id=<?php echo $fotoid ?>" type="submit" name="batalsuka" class="btn btn-primary ms-2">
                                                            <i class="bi bi-heart-fill">
                                                                <?php echo mysqli_num_rows($like) ?>
                                                                Suka
                                                            </i>
                                                        </a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="like/store.php?foto_id=<?php echo $fotoid ?>" type="submit" name="suka" class="btn btn-primary ms-2">
                                                            <i class="bi bi-heart">
                                                                <?php echo mysqli_num_rows($like) ?>
                                                                Suka
                                                            </i>
                                                        </a>
                                                    <?php
                                                    }

                                                    ?>
                                                    <div class="mb-2 bg-primary text-white"></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>

            </div>
    <?php
                        }
                    } else {
                        echo "No photo found.";
                    }
    ?>
        </div>

    </div>





    </p>
    </div>


    </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
