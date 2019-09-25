<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_loket = $_POST['id_loket'];
	if (empty($id_loket)) {
		$respon = array(
				'status' => 0,
				'pesan' => 'Id loket tidak boleh kosong!'
			);
	}else{
		$loket = mysqli_query($koneksi, "DELETE FROM loket WHERE id_loket = '$id_loket'");
		if ($loket) {
			$respon = array(
					'status' => 1,
					'pesan' => "Loket berhasil dihapus"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Loket gagal dihapus"
				);
		}
	}
	echo json_encode($respon);
?>