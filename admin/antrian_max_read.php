<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$max = mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting = 1");
	$antrian = mysqli_fetch_array($max);
	if ($max) {
		$respon = array(
					'status' => 1,
					'pesan' => "Berhasil mengambil max antrian",
					'id_setting'=> $antrian['id_setting'],
					'isi' => $antrian['isi'],
					'ket'=> $antrian['keterangan']
				);
	}else{
		$respon = array(
					'status' => 0,
					'pesan'=> "Gagal mengambil antrian"
				);
	}
	echo json_encode($respon);
?>