<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    session_start();
    require "../koneksi.php";
    if (!isset($_SESSION['username'])) {
        header("location:login.php");
    }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pinterest</title>
    <link rel="icon" href="../img/pinterest-logo-icon-social-media-icon-free.png">


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        #itemmenu ul li a:hover {
            color: #BFA73E;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">

                <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(../img/2.jpg);"></a>



                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="../index.php">Home</a>
                    </li>
                    <li class="active">
                        <a href="album.php">Album</a>
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
                                <a class="hover-effect nav-link" href="../index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="hover-effect nav-link" href="album.php">Album</a>
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

                if ($_GET['menu'] == "viewalbum") {


                    if (isset($_GET['album_id'])) {
                        include "view.php";
                    } else {
                        include "view.php";
                    }
                }
            }
            ?>

            <p>
                <span class="h5">Data Album</span>
                <a class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#forminput" href="#">
                    <span class="bi bi-person-plus-fill"></span>
                    Tambah Data
                </a>

            <table class="table table-striped border border-default border-5 mt-3">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nama album</th>
                        <th>Deskripsi</th>
                        <th>Tanggal dibuat</th>
                        <th>Nama user</th>
                        <td>Album</td>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT tb_album.album_id, 
                            tb_album.nama_album, 
                            tb_album.nama_album, 
                            tb_album.deskripsi_album,
                            tb_album.tanggal_dibuat,
                            tb_user.user_id,
                            tb_user.nama_lengkap 
                            
                            FROM tb_album JOIN tb_user ON tb_album.user_id=tb_user.user_id;";

                    $result = $conn->query("$sql");
                    if (!$result) {
                        die("query gagal : " . $conn->error);
                    }
                    if ($result->num_rows > 0) {
                        $no = 0;
                        while ($row = $result->fetch_assoc()) {
                            $no++;

                    ?>
                            <tr align="center">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['nama_album']; ?></td>
                                <td><?php echo $row['deskripsi_album']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row["tanggal_dibuat"])); ?></td>
                                <td><?php echo $row['nama_lengkap']; ?></td>

                                <td>
                                <a href="view/view.php?album_id=<?php echo $row['album_id']; ?>&nama_album=<?php echo $row['nama_album'] ?>" class="btn btn-primary" >Lihat Isi Album</a>

                                </td>
                                <td>
                                    <a href="#" class="" data-bs-toggle="modal" data-bs-target="#tambah-<?php echo $row['album_id']; ?>"><i class="bi bi-pencil-square"></i></a>

                                    <a href="#" class="" data-bs-toggle="modal" data-bs-target="#hapus-<?php echo $row['album_id']; ?>"><i class="bi bi-trash-fill"></i></a>

                                    <div id="hapus-<?php echo $row['album_id']; ?>" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                            
                                                        </div>
                                                        <div class="container">
                                                            <label class="form-label mt-2 float-start" for="jml_siswa">Deskripsi Album</label>
                                                            <input class="form-control" type="text" id="deskripsi" name="deskripsi" value="<?php echo $row['deskripsi_album']; ?>" placeholder="Masukan deskripsi album nya">
                                                        </div>
                                                        <div class="container">
                                                            <label for="" class="form-label mt-2 float-start">Tanggal</label>
                                                            <input class="form-control" type="date" name="tanggal" id="tanggal" value="<?php echo $row['tanggal_dibuat']; ?>" placeholder="masukan tanggal nya">
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input class="form-control" type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input class="btn btn-warning" type="reset" name="submit" data-bs-dismiss="modal" value="batal">
                                                        <input class="btn btn-success" type="submit" name="submit" value="Simpan">

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr>
                        <td colspan='7'
                            Data belum ada.....
                        </td>
                    </tr>";
                    }

                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" align="center">hoyolab@hoyoverse.com</td>
                </tfoot>
                </tr>
            </table>
            <div id="forminput" class="modal fade" data-bs-backdrop="static" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="store.php">
                            <div class="modal-header">
                                <div class="modal-title h5">Form Input album</div>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <label class="form-label mt-2" for="kd_kelas">Album id</label>
                                    <input class="form-control" type="text" id="albumid" name="albumid" placeholder="Masukan ID Album">
                                </div>


                                <div class="container">
                                    <label class="form-label mt-2" for="jml_siswa">Nama Album</label>
                                    <input class="form-control" type="text" id="namaalbum" name="namaalbum" placeholder="Masukan Nama Album nya">
                                </div>
                                <div class="container">
                                    <label class="form-label mt-2" for="jml_siswa">Deskripsi Album</label>
                                    <input class="form-control" type="text" id="deskripsi" name="deskripsi" placeholder="Masukan deskripsi album nya">
                                </div>
                                <div class="container">
                                    <label for="" class="form-label mt-2">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" id="tanggal" placeholder="masukan tanggal nya">
                                </div>
                                <div class="container mb-2">
                                    <input class="form-control" type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                </div>

                                <div class="modal-footer">
                                    <input class="btn btn-success" type="submit" name="simpan" value="Simpan">
                                    <input class="btn btn-primary" type="reset" value="Batal" data-bs-dismiss="modal" />
                                </div>

                            </div>

                        </form>
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