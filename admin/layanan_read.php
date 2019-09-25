<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$layanan = mysqli_query($koneksi, "SELECT * FROM layanan order by urut ASC");
	$respon = array();
	while ($data_layanan = $layanan->fetch_array(MYSQLI_ASSOC)) {
		$desk =  substr($data_layanan['desk_layanan'], 0, 100);
		$output_layanan = array(
                'id_layanan' => $data_layanan['id_layanan'],
                'kode_layanan' => $data_layanan['kode_layanan'],
                'jenis_layanan' => $data_layanan['jenis_layanan'],
                'desk_layanan' => $desk,
                'urut' => $data_layanan['urut']
            );
            array_push($respon, $output_layanan);
	}
	echo json_encode($respon);
?>