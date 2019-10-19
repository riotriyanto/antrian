<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
	include '../koneksi.php';
	$id_user = $_POST['id_user'];
	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$password = md5($_POST['password']);
	$no_telp = $_POST['no_telp'];
	$level = $_POST['level'];
	if (empty($id_user AND $nik AND $nama AND $_POST['password'] AND $no_telp AND $level)) {
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
			if ($level == "admin") {
				$token = md5(md5(md5($nik).md5($password)));
				$i_user = mysqli_query($koneksi, "UPDATE user SET nik = '$nik', nama = '$nama', password = '$password', no_telp = '$no_telp', hak_akses ='$level', token = '$token' WHERE id_user = '$id_user' ");
				if ($i_user) {
					$respon = array(
								'status' => 1,
								'pesan' => "Berhasil mengedit user admin"
							);
				}else{
					$respon = array(
								'status' => 0,
								'pesan' => "Gagal mengedit user admin"
							);
				}
			}elseif ($level == "cs") {
				$token = md5(md5($nik.$password));
				$i_user = mysqli_query($koneksi, "UPDATE user SET nik = '$nik', nama = '$nama', password = '$password', no_telp = '$no_telp', hak_akses ='$level', token = '$token' WHERE id_user = '$id_user' ");
				if ($i_user) {
					$respon = array(
								'status' => 1,
								'pesan' => "Berhasil mengedit user cs"
							);
				}else{
					$respon = array(
								'status' => 0,
								'pesan' => "Gagal mengedit user cs"
							);
				}
			}elseif ($level == "operator") {
				$token = md5(md5($password.$nik));
				$i_user = mysqli_query($koneksi, "UPDATE user SET nik = '$nik', nama = '$nama', password = '$password', no_telp = '$no_telp', hak_akses ='$level', token = '$token' WHERE id_user = '$id_user' ");
				if ($i_user) {
					$respon = array(
								'status' => 1,
								'pesan' => "Berhasil mengedit user operator"
							);
				}else{
					$respon = array(
								'status' => 0,
								'pesan' => "Gagal mengedit user operator"
							);
				}
			}else{
				$respon = array(
								'status' => 0,
								'pesan' => "Level user tidak diketahui"
							);
			}
		
	}
	echo json_encode($respon);
?>