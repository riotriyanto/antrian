<?php
include 'koneksi.php';
	$nik = $_POST['nik'];
	$password = md5($_POST['password']);
	if (empty($nik AND $_POST['password'])) {
		$respon = array(
				'status' => 0,
				'pesan' => "NIK dan password harus diisi" 
			);
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = $nik");
		$cek = mysqli_fetch_array($query);
		$token = $cek['token'];
		$no_telp = $cek['no_telp'];
		if ($token ==md5(md5($nik.$no_telp))) {
			$login = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = '$nik' AND password = '$password'");
			if (mysqli_num_rows($login) == 0) {
				$respon = array(
						'status' => 0,
						'pesan' => "NIK dan password tidak sesuai",
					);
			}else{
				$respon = array(
						'status' => 1,
						'pesan' => "Login berhasil",
						'token' => $token
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