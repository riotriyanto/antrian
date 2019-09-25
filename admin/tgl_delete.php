<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_tgl = $_POST['id_tgl'];
	if (empty($id_tgl)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Id tanggal tidak valid"
			);
	}else{
		$delete = mysqli_query($koneksi, "DELETE FROM tgl_layanan WHERE id_tgl = '$id_tgl' ");
		if ($delete) {
			$respon = array(
					'status' => 1,
					'pesan' => "Tanggal berhasil dihapus"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Tanggal gagal dihapus"
				);
		}
	}
	echo json_encode($respon);
?>