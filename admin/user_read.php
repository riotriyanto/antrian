<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$query = mysqli_query($koneksi, "SELECT * FROM user WHERE nik != 'rto' ");
	if ($query) {
		$respon = array();
		while ($user = $query->fetch_array(MYSQLI_ASSOC)) {
			$output_user = array(
                'id_user' => $user['id_user'],
                'nik' => $user['nik'],
                'nama' => $user['nama'],
                'akses' => $user['hak_akses']
            );
            array_push($respon, $output_user);
		}
	}else{
		$respon = array(
					'status' => 0,
					'pesan' => "Gagal mengambil data user"
				);
	}
	echo json_encode($respon);
?>