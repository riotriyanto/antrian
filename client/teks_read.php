<?php
include '../koneksi.php';
date_default_timezone_set("Asia/Jakarta");
	$date_now = date("Y-m-d");
	$t = mysqli_query($koneksi, "SELECT * FROM teks");
	$teks = mysqli_fetch_array($t);
	if ($teks['mulai']<=$date_now AND $date_now <= $teks['akhir'] ) {
		$respon = array(
					'status' => 1,
					'pesan' => 'Berhasil mengambil teks',
					'teks'=> $teks['teks']
				);
	}else{
		$respon = array(
					'status' => 1,
					'pesan' => 'Berhasil mengambil teks',
					'teks'=> $teks['standar']
				);
	}
	echo json_encode($respon);

?>