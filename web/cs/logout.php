<?php 
// mengaktifkan session php
include '../api.php';
session_start();
$id_loket = $_SESSION['id_loket'];
$url2 = $url.'cs/logout_loket.php';

    $context2 = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query(
            array(
                'id_loket' => $id_loket
            )
        ),
        'timeout' => 60
        )
    ));
    $resp2 = file_get_contents($url2, FALSE, $context2);
// menghapus semua session
session_destroy();
// mengalihkan halaman ke halaman login
header("location:../logout.php");
?>