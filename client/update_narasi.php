<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_narator = $_POST['id_narator'];
	if (empty($id_narator)) {
		$respon = array(
					'status' => 0,
					'pesan' => 'Id narator kosong'
				);
	}else{
		$query = mysqli_query($koneksi, "UPDATE narator SET status = 'dipanggil' WHERE id_narator = '$id_narator' ");
		if ($query) {
			$respon = array(
						'status' => 1,
						'pesan' => "Update narator berhasil"
					);
		}else{
			$respon = array(
						'status' => 0,
						'pesan' => "Update narator gagal"
					);
		}
	}
	echo json_encode($respon);
?>