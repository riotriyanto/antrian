<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$narasi = $_POST['narasi'];

	if (empty($narasi)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Narasi kosong!"
			);
	}else{
		$query = mysqli_query($koneksi, "UPDATE narator set status = 'pending' WHERE narasi = '$narasi' ");
		if ($query) {
			$respon = array(
					'status' => 1,
					'pesan' => "Panggil ulang berhasil"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Panggil ulang gagal"
				);
		}
	}
	echo json_encode($respon);
?>