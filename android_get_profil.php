<?php
include 'koneksi.php';
	$nik = $_POST['nik'];
	if (empty($nik)) {
		$respon = array(
					'status' => 0,
					'pesan' => "NIK kosong"
				);
	}else{
		$pro = mysqli_query($koneksi, "SELECT * FROM user WHERE nik ='$nik' ");
		$profil = mysqli_fetch_array($pro);
		$profil_saya = array(
						'nik' => $profil['nik'],
						'nama' => $profil['nama'],
						'no_telp' => $profil['no_telp']
					);
		$respon = array(
					'status' => 1,
					'pesan' => "Berhasil mengambil profil saya",
					'data'=> $profil_saya
				);
	}
	echo json_encode($respon);
?>