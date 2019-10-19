<?php
include '../koneksi.php';
	$id_loket = $_POST["id_loket"];
        if (empty($id_loket)) {
            $respon = array(
            			'status' => 0,
            			'pesan' => "Id loket kosong"
            		);
        }else{
            $query = mysqli_query($koneksi, "UPDATE loket SET status = 'tidak aktif' WHERE id_loket='$id_loket'");            
            $respon = array(
            			'status' => 1,
            			'pesan' => "Logout berhasil"
            		);
        }
    echo json_encode($respon);
?>