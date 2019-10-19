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
				'pesan' => "Id layanan tidak boleh kosong!" 
			);
	}else{
		$del_layanan = mysqli_query($koneksi, "DELETE FROM layanan WHERE id_layanan = '$id_layanan' ");
		if ($del_layanan) {
			$respon = array(
					'status' => 1,
					'pesan' => "Layanan berhasil dihapus"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Layanan gagal dihapus"
				);
		}
	}
	echo json_encode($respon);
?>