<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include 'koneksi.php';
$nik = $_POST['nik'];
if (empty($nik)) {
	$respon = array(
				'status' => 0,
				'pesan' => "NIK kosong!"
			);
}else{
	$query_pen = mysqli_query($koneksi, "SELECT * FROM penduduk WHERE nik = '$nik' ");
	$respon = array();
	while($data_pen = $query_pen->fetch_array(MYSQLI_ASSOC)){
            $output_pen = array(
                "nik" => $data_pen['nik'],
                "nama" => $data_pen['nama'],
                "no_telp" => $data_pen['no_telp']
            );
            array_push($respon, $output_pen);
        }
}
echo json_encode($respon);
?>