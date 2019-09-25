<?php
include '../koneksi.php';
	$t = mysqli_query($koneksi, "SELECT * FROM teks");
	$teks = mysqli_fetch_array($t);
	if (mysqli_num_rows($t) > 0) {
		$respon = array(
					'status' => 1,
					'pesan' => 'Berhasil mengambil teks',
					'id_teks'=> $teks['id_teks'],
					'teks'=> $teks['teks'],
					'mulai'=> $teks['mulai'],
					'akhir'=> $teks['akhir'],
					'standar' => $teks['standar']
				);
	}else{
		$respon = array('status' => 0, 'pesan'=> "Teks kosong!" );
	}
	
	echo json_encode($respon);

?>