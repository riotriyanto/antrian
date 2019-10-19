<?php
include '../koneksi.php';
	$nik = $_POST['nik'];
	$password = md5($_POST['password']);
	if (empty($nik AND $password)) {
		$respon = array(
					'status' => 0,
					'pesan' => "Nik dan password harus diisi!"
				);
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = '$nik' AND password ='$password' ");
		if (mysqli_num_rows($query) > 0) {
			$data = mysqli_fetch_array($query);
			$token = $data['token'];
			$tokenku = md5(md5($nik.$password));
			if ($token == md5(md5($nik.$password))) {
				$respon = array(
							'status' => 1,
							'pesan' => "Berhasil login"
						);
			}else{
				$respon = array(
							'status' => 0,
							'pesan' => "Token ditolak"
						);
			}
			
		}else{
			$respon = array(
						'status' => 0,
						'pesan' => "NIK atau password salah"
					);
		}
	}
	echo json_encode($respon);
?>