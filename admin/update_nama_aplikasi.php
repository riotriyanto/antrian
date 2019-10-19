<?php
include '../koneksi.php';
	$id_setting = $_POST['id_setting'];
	$isi = $_POST['isi'];
	if (empty($id_setting)) {
		$respon = array(
					'status' => 0,
					'pesan'=> "ID setting kosong"
				);
	}elseif(empty($isi)){
		$respon = array(
					'status' => 0,
					'pesan'=> "Isi setting kosong"
				);
	}
	else{
		$update = mysqli_query($koneksi, "UPDATE setting SET  isi = '$isi' WHERE id_setting = '$id_setting' ");
		if ($update) {
			$respon = array(
						'status' => 1,
						'pesan' => "Berhasil mengubah nama aplikasi"
					);
		}else{
			$respon = array(
						'status' => 0,
						'pesan' => "Gagal mengubah nama aplikasi"
					);
		}
	}
	echo json_encode($respon);
?>