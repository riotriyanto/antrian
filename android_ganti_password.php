<?php
include 'koneksi.php';
	$nik = $_POST['nik'];
	$password_lama = md5($_POST['password_lama']);
	$password = md5($_POST['new_password']);
	if (empty($nik)) {
		$respon = array(
				'status' => 0,
				'pesan' => "NIK tidak boleh kosong!" 
			);
	}elseif(empty($_POST['new_password'] AND $_POST['password_lama'])){
		$respon = array(
				'status' => 0,
				'pesan' => "Password tidak boleh kosong!"
			);
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = $nik AND password = '$password_lama' ");
		$cek = mysqli_fetch_array($query);
		$token = $cek['token'];
		$no_telp = $cek['no_telp'];
		if ($token ==md5(md5($nik.$no_telp))) {
			$re_pas = mysqli_query($koneksi, "UPDATE user SET password= '$password' WHERE nik = '$nik' ");
			if ($re_pas) {
				$respon = array(
					'status' => 1,
					'pesan' => "Password berhasil diganti!" 
				);
			}else{
				$respon = array(
					'status' => 0,
					'pesan' => "Password gagal diganti!" 
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