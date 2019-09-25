<?php
include '../koneksi.php';
	$teks = $_POST['teks'];
	$mulai =$_POST['mulai'];
	$akhir = $_POST['akhir'];
	$de = $_POST['de'];
	if (empty($teks AND $mulai AND $akhir AND $de)) {
		$respon = array('status' => 0,'pesan'=>"Data tidak lengkap" );
	}else{
		$query = mysqli_query($koneksi, "UPDATE teks SET teks ='$teks', mulai ='$mulai', akhir = '$akhir', standar = '$de' ");
		if ($query) {
			$respon = array('status' => 1, 'pesan'=> "Berhasil edit teks");
		}else{
			$respon = array('status' => 0, 'pesan'=> "Gagal edit teks");
		}
	}
	echo json_encode($respon);
?>