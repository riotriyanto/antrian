<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$jenis_layanan = $_POST['jenis_layanan'];
	$kode_layanan = $_POST['kode_layanan'];
	$desk_layanan = $_POST['desk_layanan'];
	$urut = $_POST['urut'];
	$cek = mysqli_query($koneksi, "SELECT MAX(urut) AS maxurut FROM layanan");
	$maxur = mysqli_fetch_array($cek);
	$urutdef = $maxur['maxurut']+1;
	if (empty($urut)) {
		$urut = $urutdef;
	}

	if (empty($jenis_layanan AND $kode_layanan AND $desk_layanan)) {
		$respon = array(
				'status' => 1,
				'pesan' => "Data layanan harus diisi!"
			);
	}else{
		$t_layanan = mysqli_query($koneksi, "INSERT INTO layanan (jenis_layanan, kode_layanan, desk_layanan, urut) VALUES ('$jenis_layanan', '$kode_layanan', '$desk_layanan', '$urut') ");
		if ($t_layanan) {
			$respon = array(
					'status' => 1,
					'pesan' => "Layanan berhasil ditambahkan"
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Layanan gagal ditambahkan"
				);
		}
	}
	echo json_encode($respon);
?>