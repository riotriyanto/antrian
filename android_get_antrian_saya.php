<?php
include 'koneksi.php';
	date_default_timezone_set("Asia/Jakarta");
	$date_now = date("Y-m-d");
	$nik = $_POST['nik'];
	if (empty($nik)) {
		$respon = array(
				'status' => 0,
				'pesan' => "NIK tidak boleh kosong!" 
			);
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = $nik");
		$cek = mysqli_fetch_array($query);
		$token = $cek['token'];
		$no_telp = $cek['no_telp'];
		if ($token ==md5(md5($nik.$no_telp))) {
			//ambil data antrian
			$data_antrian = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE nik = '$nik' AND tgl = '$date_now' AND status = 'menunggu' ");
			// $antrian = mysqli_fetch_array($data_antrian);
			// //ambil data layanan
			// $data_layanan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$antrian[id_layanan]' ");
			// $layanan = mysqli_fetch_array($data_layanan);
			// //detail antrian
			// $det_antrian = mysqli_query($koneksi, "SELECT MAX(nomor_antrian) as max_antri FROM nomor_antrian WHERE tgl = '$date_now' AND status = 'dilayani'");
			// $s_antri = mysqli_fetch_array($det_antrian);
			// //end detail antrian
			$out = array();
			while ($data_ku = $data_antrian->fetch_array(MYSQLI_ASSOC)) {
				$data_layanan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$data_ku[id_layanan]' ");
				$layanan = mysqli_fetch_array($data_layanan);
				$det_antrian = mysqli_query($koneksi, "SELECT MAX(nomor_antrian) as max_antri FROM nomor_antrian WHERE tgl = '$date_now' AND status = 'dilayani' AND id_layanan = '$data_ku[id_layanan]'");
				$d_an=mysqli_fetch_array($det_antrian);
				if (is_null($d_an['max_antri'])) {
					$d_an['max_antri'] = "-";
					$newDate = date("d-m-Y", strtotime($data_ku['tgl']));
					$ou = array(
								'layanan' => $layanan['jenis_layanan'],
								'nomor_antrian' => $layanan['kode_layanan'].$data_ku['nomor_antrian'],
								'tgl' => $newDate,
								'jam' => $data_ku['waktu_ambil'],
								'nomor_antrian_dilayani_ssat_ini' => $d_an['max_antri'],
								'sisa_antrian_didepan_anda' => $data_ku['nomor_antrian']
							);
					array_push($out, $ou);
				}else{
					$newDate = date("d-m-Y", strtotime($data_ku['tgl']));
					$ou = array(
								'layanan' => $layanan['jenis_layanan'],
								'nomor_antrian' => $layanan['kode_layanan'].$data_ku['nomor_antrian'],
								'tgl' => $newDate,
								'jam' => $data_ku['waktu_ambil'],
								'nomor_antrian_dilayani_ssat_ini' => $d_an['max_antri'],
								'sisa_antrian_didepan_anda' => $data_ku['nomor_antrian']-$d_an['max_antri']
							);
					array_push($out, $ou);
				}
			}
			$respon = array(
					'status' =>1,
					'pesan' => "Berhasil mengambil antrian anda",
					'data' => $out
				);
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Token ditolak" 
				);
		}
	}
	echo json_encode($respon);
?>