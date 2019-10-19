<?php
include 'koneksi.php';
	$nik = $_POST['nik'];
	$notif = $_POST['notif'];
	if (empty($nik)) {
		$respon = array(
				'status' => 0,
				'pesan' => "NIK tidak boleh kosong!" 
			);
	}elseif(empty($_POST['notif'])){
		$respon = array(
				'status' => 0,
				'pesan' => "Notif tidak boleh kosong!"
			);
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = $nik");
		$cek = mysqli_fetch_array($query);
		$token = $cek['token'];
		$no_telp = $cek['no_telp'];
		if ($token ==md5(md5($nik.$no_telp))) {
			$update_notif = mysqli_query($koneksi, "UPDATE user SET notif = '$notif' WHERE nik = '$nik'");
			if ($update_notif) {
				$respon = array(
						'status' => 1,
						'pesan' => "Perubahan notif berhasil"
					);
			}else{
				$respon = array(
						'status' => 0,
						'pesan' => "Perubahan notif gagal"
					);
			}
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Token ditolak" 
				);
		}
	}
	echo json_encode($respon);
?>