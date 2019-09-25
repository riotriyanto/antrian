<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$loket = mysqli_query($koneksi, "SELECT * FROM loket ORDER BY id_loket ASC");
	$respon = array();
	while ($data_loket = $loket->fetch_array(MYSQLI_ASSOC)) {
		$output_loket = array(
                'id_loket' => $data_loket['id_loket'],
                'nomor_loket' => $data_loket['nomor_loket'],
                'status' => $data_loket['status']
            );
            array_push($respon, $output_loket);
	}
	echo json_encode($respon);
?>