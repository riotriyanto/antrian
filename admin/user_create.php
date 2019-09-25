<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
	include '../koneksi.php';
	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$password = md5($_POST['password']);
	$no_telp = $_POST['no_telp'];
	$level = $_POST['level'];
	if (empty($nik AND $nama AND $password AND $no_telp AND $level)) {
		$respon = array(
						'status' => 0,
						'pesan' => "Data yang dimasukkan tidak lengkap"
					);
	}else{
		$cek_pen = mysqli_query($koneksi, "SELECT * FROM penduduk WHERE nik = '$nik' ");
					if (mysqli_num_rows($cek_pen) == 0) {
						$penduduk = mysqli_query($koneksi, "INSERT INTO penduduk (nik, nama, no_telp) VALUES ('$nik', '$nama', '$no_telp') ");
					}else{
						$penduduk = mysqli_query($koneksi, "UPDATE penduduk SET nama = '$nama', no_telp = '$no_telp' WHERE nik = '$nik' ");
					}
		$c_n = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = $nik ");
		if (mysqli_num_rows($c_n)>0) {
			$respon = array(
						'status' => 0,
						'pesan' => "NIK sudah terdaftar"
					);
		}else{
			if ($level == "admin") {
				$token = md5(md5(md5($nik).md5($password)));
				$i_user = mysqli_query($koneksi, "INSERT INTO user (nik, nama, password, no_telp, hak_akses , token)VALUES ('$nik', '$nama', '$password', '$no_telp', '$level', '$token') ");
				if ($i_user) {
					$respon = array(
								'status' => 1,
								'pesan' => "Berhasil menambah user admin"
							);
				}else{
					$respon = array(
								'status' => 0,
								'pesan' => "Gagal menambah user admin"
							);
				}
			}elseif ($level == "cs") {
				$token = md5(md5($nik.$password));
				$i_user = mysqli_query($koneksi, "INSERT INTO user (nik, nama, password, no_telp, hak_akses , token)VALUES ('$nik', '$nama', '$password', '$no_telp', '$level', '$token') ");
				if ($i_user) {
					$respon = array(
								'status' => 1,
								'pesan' => "Berhasil menambah user cs"
							);
				}else{
					$respon = array(
								'status' => 0,
								'pesan' => "Gagal menambah user cs"
							);
				}
			}elseif ($level == "operator") {
				$token = md5(md5($password.$nik));
				$i_user = mysqli_query($koneksi, "INSERT INTO user (nik, nama, password, no_telp, hak_akses , token) VALUES ('$nik', '$nama', '$password', '$no_telp', '$level', '$token') ");
				if ($i_user) {
					$respon = array(
								'status' => 1,
								'pesan' => "Berhasil menambah operator"
							);
				}else{
					$respon = array(
								'status' => 0,
								'pesan' => "Gagal menambah operator"
							);
				}
			}else{
				$respon = array(
								'status' => 0,
								'pesan' => "Level user tidak diketahui"
							);
			}
		}
	}
	echo json_encode($respon);
?>