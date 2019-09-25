<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$nomor_loket = $_POST['nomor_loket'];
	if (empty($nomor_loket)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Nomor loket harus diisi!"
			);
	}else{
		$cek_loket = mysqli_query($koneksi, "SELECT * FROM loket WHERE nomor_loket = '$nomor_loket'");
		$cek = mysqli_num_rows($cek_loket);
		if ($cek > 0) {
			$respon = array(
					'status' => 0,
					'pesan' => "Nomor loket sudah ada"
				 );
		}else{
			$t_loket = mysqli_query($koneksi, "INSERT INTO loket (nomor_loket, status) VALUES ('$nomor_loket', 'tidak aktif')");
			if ($t_loket) {
				$respon = array(
						'status' =>1,
						'pesan' => "Berhasil menambah loket" 
					);
			}else{
				$respon = array(
						'status' => 0,
						'pesan' => "Gagal menambah loket"
					);
			}
		}
	}
	echo json_encode($respon);
?>