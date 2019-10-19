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
        $ket = $_POST['ket'];

        
        
        if (empty($id_layanan AND $nik AND $id_user_cs AND $id_loket)) {
           $respon = array(
					'status' => 0,
					'pesan' => "Data tidak lengkap"
				);
        }else{
            if ($ket == "") {
                // $query = mysqli_query($koneksi, "INSERT INTO transaksi_layani (id_layanan, nik, id_user_cs, id_loket, no_antrian, status) VALUES ('$id_layanan', '$nik', '$id_user_cs', '$id_loket', '$no_antrian', 'hangus') ");
                $qu = "UPDATE nomor_antrian SET status = 'terlewati' WHERE id_nomor = $id_nomor";
            }else{
                $query = mysqli_query($koneksi, "INSERT INTO transaksi_layani (id_layanan, nik, id_user_cs, id_loket, no_antrian, status) VALUES ('$id_layanan', '$nik', '$id_user_cs', '$id_loket', '$no_antrian', 'hangus') ");
                $qu = "UPDATE nomor_antrian SET status = 'selesai' WHERE id_nomor = $id_nomor";
        	}
            $q = mysqli_query($koneksi, $qu);
            // $ex = $koneksi->query($q);
            if (empty($ket)) {
                if ($q) {
                     $respon = array(
                        'status' => 1,
                        'pesan' => "Data berhasil disimpan"
                    );
                }else{
                    $respon = array(
                        'status' => 0,
                        'pesan' => "Data gagal disimpan",
                        'q'=>$qu
                    );
                }
            }
            else{
                if ($query && $q) {
                     $respon = array(
                        'status' => 1,
                        'pesan' => "Data berhasil disimpan"
                    );
                }else{
                    $respon = array(
                        'status' => 0,
                        'pesan' => "Data gagal disimpan",
                        'q'=>$qu
                    );
                }
            }
        }
	echo json_encode($respon);
?>