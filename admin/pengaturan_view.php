<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$setting = mysqli_query($koneksi, "SELECT * FROM setting order by id_setting DESC");
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