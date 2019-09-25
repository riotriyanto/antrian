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
		$loket = mysqli_query($koneksi, "SELECT * FROM loket WHERE id_loket = '$id_loket'");
		$respon = array();
		while ($data_layanan = $loket->fetch_array(MYSQLI_ASSOC)) {
			$output_layanan = array(
	                'id_loket' => $data_layanan['id_loket'],
	                'nomor_loket' => $data_layanan['nomor_loket'],
	                'status' => $data_layanan['status']
	            );
	            array_push($respon, $output_layanan);
		}
	}
	echo json_encode($respon);
?>