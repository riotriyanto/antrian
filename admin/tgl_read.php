<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$tgl = mysqli_query($koneksi, "SELECT * FROM tgl_layanan");
	$respon = array();
	while ($data_tgl = $tgl->fetch_array(MYSQLI_ASSOC)) {
		$output_tgl = array(
                'id_tgl' => $data_tgl['id_tgl'],
                'tgl' => $data_tgl['tgl']
            );
            array_push($respon, $output_tgl);
	}
	echo json_encode($respon);
?>