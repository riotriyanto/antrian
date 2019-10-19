<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include 'koneksi.php';
    if (empty($_POST['id_layanan'])) {
        $respon = array(
                'status' => 0,
                'pesan' => "Id layanan kosong"
            );
    }else{
        $id_layanan = $_POST['id_layanan'];
        $query_layanan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan ='$id_layanan' ");
        $respon = array();
        while($data_layanan = $query_layanan->fetch_array(MYSQLI_ASSOC)){
                $output_layanan = array(
                    "id_layanan" => $data_layanan['id_layanan'],
                    "jenis_layanan" => $data_layanan['jenis_layanan'],
                    "kode_layanan" => $data_layanan['kode_layanan'],
                    "syarat" => $data_layanan{'desk_layanan'}
                );
                array_push($respon, $output_layanan);
            }
    }
    echo json_encode($respon);
?>