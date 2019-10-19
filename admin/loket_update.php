<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_loket = $_POST['id_loket'];
	$nomor_loket = $_POST['nomor_loket'];
	if (empty($id_loket AND $nomor_loket)) {
		$respon = array(
				'status' => 0,
				'pesan' => 'Id loket tidak boleh kosong!'
			);
	}else{
		$loket = mysqli_query($koneksi, "UPDATE loket SET nomor_loket = '$nomor_loket' WHERE id_loket = '$id_loket'");
		if ($loket) {
			$respon = array(
					'status' => 1,
					'pesan' => "Loket berhasil diubah"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Loket gagal diubah"
				);
		}
	}
	echo json_encode($respon);
?>