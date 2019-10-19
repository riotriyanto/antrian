<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");
    $date_now = date("Y-m-d");
	$nik = $_POST['nik'];
	$qr_code = $_POST['qr_code'];
	//cek token user
	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE nik = $nik");
	$cek = mysqli_fetch_array($query);
	$token = $cek['token'];
	$no_telp = $cek['no_telp'];
	$cek_tgl = mysqli_query($koneksi, "SELECT * FROM tgl_layanan WHERE tgl = '$date_now'");
    if (mysqli_num_rows($cek_tgl) > 0) {
        $respon = array('status' => 0, 'pesan'=> "Tidak bisa menggunakan layanan pada hari ini!" );
    }else{
    	if ($token ==md5(md5($nik.$no_telp))) {
			//cek token qr
			$cek_qr = mysqli_query($koneksi, "SELECT * FROM qr_code WHERE kode = '$qr_code' AND status ='belum_dipakai'");
			$num_qr = mysqli_num_rows($cek_qr);
			if ($num_qr > 0) {
				$update_qr = mysqli_query($koneksi, "UPDATE qr_code SET status ='sudah_dipakai', nik = '$nik' ");
				if ($update_qr) {
					$date_now = date("Y-m-d");
					$query_layanan = mysqli_query($koneksi, "SELECT * FROM layanan");
					$respon = array();
					while($data_layanan = $query_layanan->fetch_array(MYSQLI_ASSOC)){
	                    $id_layanan = $data_layanan['id_layanan'];

	                    $antrian_jml = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE id_layanan =  '$id_layanan' AND tgl = '$date_now' ");
	                    $jml = mysqli_num_rows($antrian_jml);

	                    $antrian_blm = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE id_layanan =  '$id_layanan' AND status = 'menunggu' AND tgl = '$date_now'");
	                    $blm = mysqli_num_rows($antrian_blm);
	                    $output_layanan = array(
	                        "id_layanan" => $data_layanan['id_layanan'],
	                        "jenis_layanan" => $data_layanan['jenis_layanan'],
	                        "kode_layanan" => $data_layanan['kode_layanan'],
	                        "antrian_terlayani" => $jml-$blm,
	                        "antrian_belum_terlayani" => $blm,
	                        "jumlah_antrian" => $jml
	                    );
	                    array_push($respon, $output_layanan);
	                }
				}else{
					$respon = array(
						'status' => 0,
						'pesan' => "Gagal menampilkan layanan" 
					);
				}
			}else{
				$respon = array(
					'status' => 0,
					'pesan' => "Token QR Code ditolak" 
				);
			}
		}else{
			$respon = array(
					'status' => 0,
					'pesan' => "Token ditolak" 
				);
		}
    }
	echo json_encode($respon);
?>