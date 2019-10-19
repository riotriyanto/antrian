<?php
include 'koneksi.php';
	date_default_timezone_set("Asia/Jakarta");
	$date_now = date("Y-m-d");
	$jam = date("h:i:s");
	$nik = $_POST['nik'];
	$latitude1 = $_POST['latitude'];
	$longitude1 = $_POST['longitude'];
	$latitude2 = "-7.7126017";
	$longitude2= "110.5906309";
	$id_layanan = $_POST['id_layanan'];
	if (empty($nik AND $id_layanan)) {
		$respon = array(
				'status' => 0,
				'pesan' => "Lengkapi data sebelum ambil antrian" 
			);
	}elseif(empty($latitude1 AND $longitude1)){
		$respon = array(
					'status' => 0,
					'pesan' => "Lokasi anda tidak terdeteksi"
				);
	}else{
		//cek token user
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = $nik");
		$cek = mysqli_fetch_array($query);
		$token = $cek['token'];
		$no_telp = $cek['no_telp'];
		if ($token ==md5(md5($nik.$no_telp))) {
			//cek lokasi
			$theta = $longitude1 - $longitude2; 
			$distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
			$distance = acos($distance); 
			$distance = rad2deg($distance); 
			$distance = $distance * 60 * 1.1515;
			$max = mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting = 2");
			$antrian = mysqli_fetch_array($max);
			$max_jarak = $antrian['isi'];
			if ($distance <= $max_jarak) {
				//get_data_user
				$data = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = $nik");
				$data_user = mysqli_fetch_array($data);
				$nama = $data_user['nama'];
				$q_layanan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$id_layanan'");
				$d_layanan = mysqli_fetch_array($q_layanan);
				$cek_max_antri = mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting ='1' ");
				// $max = mysqli_fetch_array($cek_max_antri);
				//ambil no antrian terakhir
				$ambil_no_terakhir = mysqli_query($koneksi, "SELECT MAX(nomor_antrian) as antrian_terakhir FROM nomor_antrian WHERE tgl = '$date_now' AND id_layanan = '$id_layanan'");
				$cek_max_antri = mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting ='1' ");
				$max = mysqli_fetch_array($cek_max_antri);
				$dat = mysqli_fetch_array($ambil_no_terakhir);
					$antrian = $dat['antrian_terakhir']+1;
				//ambil layanan
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
						//ambil antrian	
						$ngantri = mysqli_query($koneksi, "INSERT INTO nomor_antrian (id_layanan, nik, nama, waktu_ambil, tgl, nomor_antrian, status) VALUES ('$id_layanan', '$nik', '$nama', '$jam', '$date_now', '$antrian','menunggu')");
						if ($ngantri) {
							$respon = array(
									'status' => 1,
									'pesan' => "Berhasil mengambil nomor antrian",
									'nik' => $nik,
									'nama' => $nama,
									'layanan' => $d_layanan['jenis_layanan'],
									'kode_layanan' => $d_layanan['kode_layanan'],
									'nomor_antrian' => $antrian,
									'lat' => $latitude1,
									'long'=> $longitude1,
									'an'=>$dat

								);
						}else{
							$respon = array(
									'status' => 0,
									'pesan' => "Gagal mengambil nomor antrian, anda harus berada pada radius "
								);
						}
					}
					// cek max antrian perorang end
					
				}
			}else{
				$respon = array(
					'status' => 0,
					'pesan' => "Lokasi anda tidak terjangkau, Anda harus berada pada radius ".$max_jarak." KM"
					//'pesan' => "Lokasi anda tidak terjangkau, Anda berada diluar jangkauan"
				);
			}
			//lokasi
			
			
		}else{
			$respon = array(
				'status' => 0,
				'pesan' => "Token ditolak" 
			);
		}

	}
	echo json_encode($respon);
?>