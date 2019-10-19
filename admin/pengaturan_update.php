<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_setting =  $_POST['id_setting'];
	$isi =  $_POST['isi'];
	$keterangan =  $_POST['keterangan'];
	if (empty($id_setting AND $isi)) {
		$respon = array('status' => 0,  'pesan'=> "Id setting atau isi kosong" );
	}else{
		$up = mysqli_query($koneksi, "UPDATE setting SET isi = '$isi', keterangan = '$keterangan' WHERE id_setting = '$id_setting' ");
		if ($up) {
			$respon = array('status' => 1, 'pesan' => "Berhasil mengubah pengaturan" );
		}else{
			$respon = array('status'=>0, 'pesan'=>"Gagal mengubah pengaturan");
		}
	}
	echo json_encode($respon);
?>