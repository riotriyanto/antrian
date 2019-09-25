<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
	$id_user = $_POST['id_user'];
	if (empty($id_user)) {
		$respon = array(
					'status' => 0,
					'pesan' => 'ID user kosong'
				);
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user' ");
		if ($query) {
			$respon = array();
			while ($user = $query->fetch_array(MYSQLI_ASSOC)) {
				$output_user = array(
	                'id_user' => $user['id_user'],
	                'nik' => $user['nik'],
	                'nama' => $user['nama'],
	                'no_telp' =>$user['no_telp'],
	                'level' => $user['hak_akses']
	            );
	            array_push($respon, $output_user);
			}
		}else{
			$respon = array(
						'status' => 0,
						'pesan' => "Gagal mengambil data user"
					);
		}
	}
	echo json_encode($respon);
?>