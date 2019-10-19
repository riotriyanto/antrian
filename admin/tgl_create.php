<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$tgl = $_POST['tgl'];
	if (empty($tgl)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Tanggal tidak boleh kosong"
			);
	}else{
		$tambah = mysqli_query($koneksi, "INSERT INTO tgl_layanan (tgl) VALUES('$tgl') ");
		if ($tambah) {
			$respon = array(
					'status' => 1,
					'pesan' => "Tanggal berhasil ditambahkan"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Tanggal gagal ditambahkan"
				);
		}
	}
	echo json_encode($respon);
?>