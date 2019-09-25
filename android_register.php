<?php
include 'koneksi.php';
	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$no_telp = $_POST['no_telp'];
	$password = md5($_POST['password']);
	$token = md5(md5($nik.$no_telp));
	$player_id = $_POST['player_id'];
	if (empty($nik AND $nama AND $no_telp AND $_POST['password'] AND $player_id)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Data yang diisi tidak lengkap"
			 );
	}elseif (strlen($nik) != 16) {
		$respon = array(
				'status' => 0,
				'pesan' => "NIK harus diisi 16 digit"
			 );
	}
	else{
		$cek = mysqli_query($koneksi, "SELECT nama FROM user WHERE nik = $nik");
		if (mysqli_num_rows($cek) != 0) {
			$respon = array(
				'status' => 0,
				'pesan' => "NIK sudah terdaftar"
			 );
		}else{
			$register = mysqli_query($koneksi, "INSERT INTO user (nama, nik, no_telp, password, hak_akses, token , player_id) VALUES ('$nama', '$nik', '$no_telp', '$password', 'android', '$token', '$player_id')");
			$cek_pen = mysqli_query($koneksi, "SELECT * FROM penduduk WHERE nik = '$nik' ");
			if (mysqli_num_rows($cek_pen) == 0) {
				$penduduk = mysqli_query($koneksi, "INSERT INTO penduduk (nik, nama, no_telp) VALUES ('$nik', '$nama', '$no_telp') ");
			}else{
				$penduduk = mysqli_query($koneksi, "UPDATE penduduk SET nama = '$nama', no_telp = '$no_telp' WHERE nik = '$nik' ");
			}
			if ($register && $penduduk) {
				$respon = array(
						'status' => 1,
						'pesan' => 'Registrasi berhasil',
						'token' => $token
					);
			}else{
				$respon = array(
						'status' => 0,
						'pesan' => "Registrasi gagal" 
					);
			}
		}
	}
	echo json_encode($respon);
?>