<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_user = $_POST['id_user'];
	if (empty($id_user)) {
		$respon = array(
					'status' => 0,
					'pesan' => "ID user kososng"
				);
	}else{
		$del = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user' ");
		if ($del) {
			$respon = array(
						'status' => 1,
						'pesan' => "Berhasil menghapus user"
					);
		}else{
			$respon = array(
						'status' => 0,
						'pesan' => "Gagal menghapus user"
					);
		}
	}
	echo json_encode($respon);
?>