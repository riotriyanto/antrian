<?php
include '../koneksi.php';
$query_gambar = mysqli_query($koneksi, "SELECT * FROM gambar_android WHERE id_gambar='$_POST[id_gambar]'");
            $respon = array();
            while($data_gambar = $query_gambar->fetch_array(MYSQLI_ASSOC)){
                    $output = array(
                        "id_gambar" => $data_gambar['id_gambar'],
                        "deskripsi" => $data_gambar['deskripsi'],
                        "gambar" => $data_gambar['gambar']
                    );
                    array_push($respon, $output);
                }
                echo json_encode($respon);
?>