<?php
require "../koneksi.php";
session_start();

$fotoid = $_POST['fotoid'];
// $id = $_POST['komentar_id'];


// $sql = "DELETE FROM tb_komentarfoto WHERE komentar_id='$id'";

// $result = $conn->query($sql);
// if(!$result){
//     die ("Ada kesalhan : " .$conn->error);
// }
// if($conn->affected_rows){
//     header("Location: ../view.php?foto_id=" . urlencode($fotoid));
// }




// Periksa apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
    die("Anda belum login");
}

// Periksa apakah form penghapusan dikirim
$comment_id = $_POST['komentar_id'];
    
    // Ambil user_id dari sesi
    $user_id = $_SESSION['user_id'];
    
    // Periksa apakah pengguna memiliki hak untuk menghapus komentar
    $stmt = $conn->prepare("SELECT user_id FROM tb_komentarfoto WHERE komentar_id = ? LIMIT 1");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $stmt->store_result();
    
    // Jika komentar ditemukan
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($comment_owner_id);
        $stmt->fetch();
        
        // Periksa apakah pengguna adalah pemilik komentar
        if ($comment_owner_id == $user_id) {
            // Hapus komentar
            $delete_stmt = $conn->prepare("DELETE FROM tb_komentarfoto WHERE komentar_id = ?");
            $delete_stmt->bind_param("i", $comment_id);
            if ($delete_stmt->execute()) {
                header("Location: ../view.php?foto_id=" . urlencode($fotoid) . "&Komentar_berhasil_dihapus");
            } else {
                header("Location: ../view.php?foto_id=" . urlencode($fotoid) . "&Gagal Menghapus Komentar");
            }
        } else {
             header("Location: ../view.php?foto_id=" . urlencode($fotoid) . "&Anda_tidak_memiliki_izin_untuk_menghapus_komentar_orang");
        }
    } else {
        header("Location: ../view.php?foto_id=" . urlencode($fotoid) . "&Komentar_tidak_ditemukan");
    }
    
    $stmt->close();
