<?php
include '../koneksi.php';
    $id_user = $_POST["id_user"];
        $id_loket = $_POST["id_loket"];
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        if ((empty($id_user))) {
            $respon = array(
                        'status' => 0,
                        'pesan' => "User kosong"
                    );
        } else if ((empty($id_loket))) {
             $respon = array(
                        'status' => 0,
                        'pesan' => "Loket kosong"
                    );
        } else {
                $sql_tambahtransaksiloket = "INSERT INTO transaksi_loket (id_user, id_loket, waktu) VALUES ('$id_user','$id_loket', '$waktu')";
                $query_tambahtransaksiloket = $koneksi->query($sql_tambahtransaksiloket);
                if ($query_tambahtransaksiloket){
                    $respon = array(
                        'status' => 1,
                        'pesan' => "Berhasil"
                    );
                } else {
                    $respon = array(
                        'status' => 0,
                        'pesan' => "Gagal"
                    );
                }
          }
    echo json_encode($respon);
?>