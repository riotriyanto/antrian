<?php
include '../koneksi.php';
	$id_setting = $_POST['id_setting'];
	$isi = $_POST['isi'];
	if (empty($isi)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Data tidak lengkap"
			);
	}else{
		$update = mysqli_query($koneksi, "UPDATE setting SET isi = '$isi' WHERE id_setting = '$id_setting' ");
		if ($update) {
			$respon = array(
					'status' => 1,
					'pesan' => "Pengaturan berhasil diubah"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Pengaturan gagal diubah"
				);
		}
	}
	echo json_encode($respon);
?>