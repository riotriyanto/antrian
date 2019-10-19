<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_layanan = $_POST['id_layanan'];
	if (empty($id_layanan)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Id layanan kosong"
			);
	}else{
		$layanan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$id_layanan' ");
		$respon = array();
		while ($data_layanan = $layanan->fetch_array(MYSQLI_ASSOC)) {
			$output_layanan = array(
	                'id_layanan' => $data_layanan['id_layanan'],
	                'kode_layanan' => $data_layanan['kode_layanan'],
	                'jenis_layanan' => $data_layanan['jenis_layanan'],
	                'desk_layanan' => $data_layanan['desk_layanan'],
	                'urut' => $data_layanan['urut']
	            );
	            array_push($respon, $output_layanan);
		}
	}
	echo json_encode($respon);
?>