<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    session_start();
    require "koneksi.php";
    if (!isset($_SESSION['username'])) {
        header("location:login.php");
    }

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
    <link rel="stylesheet" href="css/style3css">
    <style>
        #itemmenu ul li a:hover {
            color: #BFA73E;
            font-weight: bold;
        }
          /* Custom CSS for Pinterest-like Design */
    .pin-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 16px;
    }

    .pin {
      position: relative;
      overflow: hidden;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .pin img {
      width: 100%;
      border-radius: 8px 8px 0 0;
    }

    .pin-content {
      padding: 12px;
    }

    .like-btn {
      position: absolute;
      top: 8px;
      right: 8px;
      background-color: white;
      border: none;
      cursor: pointer;
    }

    .comment-list {
      list-style: none;
      padding: 0;
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

            <?php
            if (isset($_GET['menu'])) {

                if ($_GET['menu'] == "viewfoto") {


                    if (isset($_GET['foto_id'])) {
                        include "view.php";
                    } else {
                        include "view.php";
                    }
                }
            }
            ?>

            <p>
            <h1 class="">Selamat Datang <?php echo $_SESSION['username']; ?> di Pinterest</h1>

            <div class="mt-5">
                <h3>Foto terbaru</h3>

                <div class="pin-container">
                    <?php
                    $sql = "SELECT 
                tb_foto.foto_id,
                tb_foto.judul_foto,
                tb_foto.deskripsi_foto,
                tb_foto.tanggal_unggah,
                tb_foto.lokasi_file,
                tb_user.user_id,
                tb_user.username
        
                
                        FROM tb_foto   JOIN tb_user ON tb_user.user_id=tb_foto.user_id ";

                    $result = $conn->query("$sql");
                    if (!$result) {
                        die("query gagal : " . $conn->error);
                    }
                    if ($result->num_rows > 0) {
                        $no = 0;
                        while ($row = $result->fetch_assoc()) {
                            $no++;
                    ?>

                            <!-- Pin 1 -->
                            <div class="pin">
                                <a href="view.php?foto_id=<?php echo $row['foto_id']; ?>">
                                    <img style="width: 350px;" class="card-img-top img-fluid" src="img/<?php echo $row['lokasi_file']; ?>" alt="Image 1">
                                    <!-- <img src="https://cdn.idntimes.com/content-images/duniaku/post/20201226/wallpaper-hape-spongebob-1-cfef0582a80ae534cc74a72bc649fdaf.jpg" alt="Image 1" class="img-fluid"> -->
                                    <div class="pin-content">

                                        <div class="comment-section">
                                            <h3><?php echo $row['judul_foto'] ?></h3>
                                            <h6>User Upload : <?php echo $row['username'] ?></h6>

                                            <ul class="comment-list" id="commentList2">
                                                <li class="commen">Last Update <?php echo $row['tanggal_unggah'] ?></li>
                                            </ul>
                                        </div> 
                                    </div>
                                </a>
                            </div>

                            <!-- Add more pins as needed -->









                    <?php
                        }
                    }
                    ?>
                </div>
            </div>





        </div>

        </p>

    </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>