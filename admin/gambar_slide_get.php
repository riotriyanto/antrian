<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
$query_gambar = mysqli_query($koneksi, "SELECT * FROM gambar_slide");
            $respon = array();
            while($data_gambar = $query_gambar->fetch_array(MYSQLI_ASSOC)){
                    $output = array(
                        "id_gambar" => $data_gambar['id_gambar'],
                        "gambar" => $data_gambar['gambar']
                    );
                    array_push($respon, $output);
                }
                echo json_encode($respon);
?>