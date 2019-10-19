<?php
include 'koneksi.php';
	date_default_timezone_set("Asia/Jakarta");
	$date_now = date("Y-m-d");
	$jam = date("h:i:s");
	$id_layanan = $_POST['id_layanan'];
	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$no_telp = $_POST['no_telp'];
	if (empty($id_layanan AND $nik AND $nama)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Lengkapi data untuk mengambil antrian!" 
			);
	}else{
		//ambil no antrian terakhir
			$ambil_no_terakhir = mysqli_query($koneksi, "SELECT MAX(nomor_antrian) as antrian_terakhir FROM nomor_antrian WHERE tgl = '$date_now' AND id_layanan = '$id_layanan'");
			$dat = mysqli_fetch_array($ambil_no_terakhir);
			$antrian = $dat['antrian_terakhir']+1;
			//ambil layanan
			//count antrian
			$count = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE tgl = '$date_now' AND id_layanan = '$id_layanan'");
			$jml = mysqli_num_rows($count);
			$q_layanan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$id_layanan'");
			$d_layanan = mysqli_fetch_array($q_layanan);
			//detail antrian
			$det_antrian = mysqli_query($koneksi, "SELECT MAX(nomor_antrian) as max_antri FROM nomor_antrian WHERE tgl = '$date_now' AND status = 'dilayani'");
			$s_antri = mysqli_fetch_array($det_antrian);
			if ($det_antrian) {
				$respon = array(
						'status' => 1,
						'pesan' => "Berhasil mengambil nomor antrian",
						'nik' => $nik,
						'nama' => $nama,
						'layanan' => $d_layanan['jenis_layanan'],
						'nomor_antrian' => $d_layanan['kode_layanan'].$antrian,
						'no_antrian_dilayani_saat_ini' => $s_antri['max_antri'],
						'sisa_antrian_didepan_anda' => $antrian-1-$s_antri['max_antri'],
						'jumlah'=> $jml+1,
						'tgl' => $date_now,
						'waktu' => $jam

					);
			}else{
				$respon = array(
						'status' => 0,
						'pesan' => "Gagal mengambil nomor antrian"
					);
			}
	}
	echo json_encode($respon);
?>