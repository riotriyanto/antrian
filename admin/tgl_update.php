<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_tgl = $_POST['id_tgl'];
	$tgl = $_POST['tgl'];
	if (empty($id_tgl AND $tgl)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Id tanggal tidak valid"
			);
	}else{
		$update = mysqli_query($koneksi, "UPDATE tgl_layanan SET tgl = '$tgl' WHERE id_tgl = '$id_tgl' ");
		if ($update) {
			$respon = array(
					'status' => 1,
					'pesan' => "Tanggal berhasil diubah"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Tanggal gagal diubah"
				);
		}
	}
	echo json_encode($respon);
?>