<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
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
	}elseif (strlen($nik) != 16) {
		$respon = array(
				'status' => 0,
				'pesan' => "NIK harus diisi 16 digit"
			 );
	}
	else{
		//ambil no antrian terakhir
			$ambil_no_terakhir = mysqli_query($koneksi, "SELECT MAX(nomor_antrian) as antrian_terakhir FROM nomor_antrian WHERE tgl = '$date_now' AND id_layanan = '$id_layanan'");
			$cek_max_antri = mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting ='1' ");
			$max = mysqli_fetch_array($cek_max_antri);
			$dat = mysqli_fetch_array($ambil_no_terakhir);
				$antrian = $dat['antrian_terakhir']+1;
			if ($dat['antrian_terakhir']+1 > $max['isi']) {
				$respon = array('status' => 0,
								'pesan'=> 'Jumlah antrian sudah melampau kuota'
							);
			}else{
				// cek max antrian perorang
				$cek = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE tgl = '$date_now' AND nik ='$nik' AND id_layanan='$id_layanan' ");
				if (mysqli_num_rows($cek) > 3) {
					$respon = array(
							'status' => 0,
							'pesan' => "Anda melampaui batas maksimal pengambilan nomor antrian"
						);
				}else{
					//ambil layanan
					//count antrian
					$count = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE tgl = '$date_now' AND id_layanan = '$id_layanan'");
					$jml = mysqli_num_rows($count);
					$q_layanan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$id_layanan'");
					$d_layanan = mysqli_fetch_array($q_layanan);
					//ambil antrian
					$cek_pen = mysqli_query($koneksi, "SELECT * FROM penduduk WHERE nik = '$nik' ");
					if (mysqli_num_rows($cek_pen) == 0) {
						$penduduk = mysqli_query($koneksi, "INSERT INTO penduduk (nik, nama, no_telp) VALUES ('$nik', '$nama', '$no_telp') ");
					}else{
						$penduduk = mysqli_query($koneksi, "UPDATE penduduk SET nama = '$nama', no_telp = '$no_telp' WHERE nik = '$nik' ");
					}
					$ngantri = mysqli_query($koneksi, "INSERT INTO nomor_antrian (id_layanan, nik, nama, waktu_ambil, tgl, nomor_antrian, status) VALUES ('$id_layanan', '$nik', '$nama', '$jam', '$date_now', '$antrian','menunggu')");
					//detail antrian
					$det_antrian = mysqli_query($koneksi, "SELECT MAX(nomor_antrian) as max_antri FROM nomor_antrian WHERE tgl = '$date_now' AND status = 'dilayani'");
					$s_antri = mysqli_fetch_array($det_antrian);
					if ($ngantri && $penduduk) {
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
								'waktu' => $jam,
								'n'=>$dat

							);
					}else{
						$respon = array(
								'status' => 0,
								'pesan' => "Gagal mengambil nomor antrian"
							);
					}
				}
				
			}
	}
	echo json_encode($respon);
?>