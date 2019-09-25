<?php
include 'koneksi.php';
	$nik = $_POST['nik'];
	$password = md5($_POST['password']);
	$tok = md5(md5(md5($nik).md5($password)));
	// echo $tok;
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
			// echo"<br>";
			// echo $token;
			$tokenku = md5(md5($password.$nik));
			if ($token == md5(md5($nik.$password))) {
				$respon = array(
							'status' => 1,
							'pesan' => "Berhasil login",
							'nama' => $data['nama'],
							'id_user' => $data['id_user'],
							'level' => 2
						);
			}elseif ($token == md5(md5(md5($nik).md5($password)))) {
				$respon = array(
							'status' => 1,
							'pesan' => "Berhasil login",
							'nama' => $data['nama'],
							'id_user' => $data['id_user'],
							'level' => 1
						);
			}
			elseif ($token == md5(md5($password.$nik))) {
				$respon = array(
							'status' => 1,
							'pesan' => "Berhasil login",
							'nama' => $data['nama'],
							'id_user' => $data['id_user'],
							'level' => 3
						);
			}
			else{
				$respon = array(
							'status' => 0,
							'pesan' => "Token ditolak",
							'token'=>$tokenku
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