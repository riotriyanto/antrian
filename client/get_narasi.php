<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$query = mysqli_query($koneksi, "SELECT MIN(id_narator) as min FROM narator WHERE status ='pending'");
	$id = mysqli_fetch_array($query);
	$data = mysqli_query($koneksi, "SELECT * FROM narator WHERE id_narator = '$id[min]' ");
	$dat =mysqli_fetch_array($data);
	if ($query) {
		$respon = array(
					'status' => 1,
					'pesan' => "Berhasil mengambil narasi",
					'id_narator' => $dat['id_narator'],
					'nomor_antrian' => $dat['nomor_antrian'],
					'loket' => $dat['loket'],
					'narasi' => $dat['narasi']
				);
	}
	echo json_encode($respon);
?>