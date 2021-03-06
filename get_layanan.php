<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");
    $date_now = date("Y-m-d");
    // die($date_now);
    $cek_tgl = mysqli_query($koneksi, "SELECT * FROM tgl_layanan WHERE tgl = '$date_now'");
    if (mysqli_num_rows($cek_tgl) > 0) {
        $respon = array('status' => 0, 'pesan'=> "Tidak bisa menggunakan layanan pada hari ini!" );
    }else{
        $query_layanan = mysqli_query($koneksi, "SELECT * FROM layanan ORDER BY urut ASC");
        // die($query_layanan);
        $respon = array();
        while($data_layanan = $query_layanan->fetch_array(MYSQLI_ASSOC)){
                $id_layanan = $data_layanan['id_layanan'];

                $antrian_jml = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE id_layanan =  '$id_layanan' AND tgl = '$date_now' ");
                $jml = mysqli_num_rows($antrian_jml);
                // die(print_r($jml));
                $saat = $antrian_blm = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE id_layanan =  '$id_layanan' AND status = 'dilayani' AND tgl = '$date_now'");
                $saat_ini = mysqli_fetch_array($saat);
                // die(print_r($saat_ini));

                $antrian_blm = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE id_layanan =  '$id_layanan' AND status = 'menunggu' AND tgl = '$date_now'");
                $blm = mysqli_num_rows($antrian_blm);
                $output_layanan = array(
                    "id_layanan" => $data_layanan['id_layanan'],
                    "jenis_layanan" => $data_layanan['jenis_layanan'],
                    "kode_layanan" => $data_layanan['kode_layanan'],
                    "antrian_terlayani" => $jml-$blm,
                    "antrian_belum_terlayani" => $blm,
                    "jumlah_antrian" => $jml,
                    "antrian_saat" => $saat_ini['nomor_antrian']
                );
                array_push($respon, $output_layanan);
            }
    }
	echo json_encode($respon);
?>