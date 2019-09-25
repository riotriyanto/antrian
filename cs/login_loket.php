<?php
	include '../koneksi.php';
	$id_loket = $_POST["id_loket"];
        if (empty($id_loket)) {
            $respon = array(
            			'status' => 0,
            			'pesan' => "Id Loket kosong!"
            		);
        }else{
            $cek = mysqli_query($koneksi, "SELECT * FROM loket WHERE id_loket = '$id_loket' ");
            $dat = mysqli_fetch_array($cek);
            if ($dat['status'] == 'aktif') {
                $respon = array(
                        'status' => 0,
                        'pesan' => "Loket sedang aktif!"
                    );
            }else{
                $query = mysqli_query($koneksi, "UPDATE loket SET status = 'aktif' WHERE id_loket='$id_loket'");            
                $respon = array(
                			'status' => 1,
                			'pesan' => "Berhasil memilih Loket"
                		);
            }
        }
    echo json_encode($respon);
?>