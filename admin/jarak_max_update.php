<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_setting = $_POST['id_setting'];
	$isi = $_POST['isi'];
	if (empty($id_setting)) {
		$respon = array(
					'status' => 0,
					'pesan'=> "ID setting kosong"
				);
	}elseif(empty($isi)){
		$respon = array(
					'status' => 0,
					'pesan'=> "Isi setting kosong"
				);
	}
	else{
		$update = mysqli_query($koneksi, "UPDATE setting SET  isi = '$isi' WHERE id_setting = '$id_setting' ");
		if ($update) {
			$respon = array(
						'status' => 1,
						'pesan' => "Berhasil mengubah maksimal jarak"
					);
		}else{
			$respon = array(
						'status' => 0,
						'pesan' => "Gagal mengubah maksimal jarak"
					);
		}
	}
	echo json_encode($respon);
?>