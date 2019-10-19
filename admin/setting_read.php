<?php
include '../koneksi.php';
	$setting = mysqli_query($koneksi, "SELECT * FROM setting");
	$respon = array();
	while ($data_setting = $setting->fetch_array(MYSQLI_ASSOC)) {
		$output_setting = array(
                'id_setting' => $data_setting['id_setting'],
                'pengaturan' => $data_setting['pengaturan'],
                'isi' => $data_setting['isi'],
                'keterangan' => $data_setting['keterangan']
            );
            array_push($respon, $output_setting);
	}
	echo json_encode($respon);
?>