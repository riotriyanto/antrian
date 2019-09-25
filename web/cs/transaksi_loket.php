<?php
include '../api.php';

    ini_set('session.gc_maxlifetime', 36000);
    session_set_cookie_params(36000);
	session_start();
    if ($_SESSION['id_loket']) {
        echo "<script>alert('Anda harus logout untuk memilih loket lagi');location='layanan.php'</script>";
    }
	$id_loket = $_POST['id_loket'];
    $id_user = $_SESSION['id_user'];
    
    $urlq = $url.'cs/transaksi_loket.php';

	$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query(
            array(
                'id_user' => $id_user,
                'id_loket' => $id_loket
            )
        ),
        'timeout' => 60
	    )
	));
    //loginloket
    
    //endloginloket
	$resp = file_get_contents($urlq, FALSE, $context);
	// print_r($resp);
    $data = json_decode($resp, true);
    if ($data['status'] == 1) {
        $_SESSION['nomor_loket'] = $_POST['nomor_loket'];
        $_SESSION['id_loket'] = $id_loket;
        // echo $_SESSION['id_loket'];
        $url2 = $url.'cs/login_loket.php';

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
        echo "<script>location='layanan.php'</script>";
    }else{
        echo "<script>location='pilihLoket.php'</script>";
    }
?>