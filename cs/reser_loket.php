<?php
	include '../koneksi.php';
	date_default_timezone_set("Asia/Bangkok");
	$jam = date("H");
	$jam = (int)$jam;
	if ($jam > 15 || $jam < 7) {
		// echo "reset";
		$query = mysqli_query($koneksi, "UPDATE loket SET status = 'tidak aktif'");     
		echo json_encode("Reset ok");
	}else{
		echo json_encode("Reset !");
	}
?>