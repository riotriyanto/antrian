<?php
	include '../koneksi.php';
	$id_gambar=$_POST['id_gambar'];
	if (empty($id_gambar)) {
		$respon = array(
					'status' => 0,
					'pesan' => "Id gambar kosong!"
				);
	}else{
		$sel = mysqli_query($koneksi, "SELECT * FROM gambar_slide WHERE id_gambar='$id_gambar'");
        $gbr = mysqli_fetch_array($sel);
        $gamb = $gbr['nama_gambar'];
        unlink("gambar_slide/$gamb");
        $del = mysqli_query($koneksi, "DELETE from gambar_slide WHERE id_gambar='$id_gambar'");
        if ($del) {
        	$respon = array(
					'status' => 1,
					'pesan' => "Berhasil menghapus gambar"
				);
        }else{
        	$respon = array(
        				'status' => 0,
        				'pesan' => "Gagal menghapus gambar",
        				'id'=> $koneksi
        			);
        }
		
	}
	echo json_encode($respon);
?>