<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
		$id_layanan = $_POST['id_layanan'];
        $nik = $_POST['nik'];
        $id_user_cs = $_POST['id_user_cs'];
        $id_loket = $_POST['id_loket'];
        $no_antrian = $_POST['no_antrian'];
        $id_nomor = $_POST['id_nomor'];
        date_default_timezone_set('Asia/Jakarta');
        $waktu_layani = date('Y-m-d H:i:s');

        
        
        if (empty($id_layanan AND $nik AND $id_user_cs AND $id_loket)) {
           $respon = array(
					'status' => 0,
					'pesan' => "Data tidak lengkap"
				);
        }else{
        	$query = mysqli_query($koneksi, "INSERT INTO transaksi_layani (id_layanan, nik, id_user_cs, id_loket, no_antrian, status) VALUES ('$id_layanan', '$nik', '$id_user_cs', '$id_loket', '$no_antrian', 'selesai') ");
            $q = "UPDATE nomor_antrian SET status = 'selesai' WHERE id_nomor = $id_nomor";
            $ex = mysqli_query($koneksi, $q);
            if ($ex && $query) {
                 $respon = array(
					'status' => 1,
					'pesan' => "Data berhasil disimpan"
				);
            }else{
                $respon = array(
					'status' => 0,
					'pesan' => "Data gagal disimpan"
				);
            }
        }
	echo json_encode($respon);
?>