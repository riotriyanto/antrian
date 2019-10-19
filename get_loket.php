<?php
include 'koneksi.php';
	$query_loket = mysqli_query($koneksi, "SELECT * FROM loket");
	$respon = array();
	while($data_loket = $query_loket->fetch_array(MYSQLI_ASSOC)){
            $output_loket = array(
                "id_loket" => $data_loket['id_loket'],
                "nomor_loket" => $data_loket['nomor_loket'],
                "status" => $data_loket['status']
            );
            array_push($respon, $output_loket);
        }
        echo json_encode($respon)
?>