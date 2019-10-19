<?php
include 'api.php';
    $nik = $_POST['NIK'];
    $pass = $_POST['password'];
    $url_api = $url."login.php";

	$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query(
            array(
                'nik' => $nik,
                'password' => $pass
            )
        ),
        'timeout' => 60
    )
));

$resp = file_get_contents($url_api, FALSE, $context);
// print_r($resp);
$data = json_decode($resp, true);
// print_r($data);
if ($data['status']) {
    ini_set('session.gc_maxlifetime', 36000);
    session_set_cookie_params(36000);
    session_start();
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['id_user'] = $data['id_user'];
    if ($data['level'] == 1) {
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['id_user'] = $data['id_user'];
        echo "<script>location='admin'</script>";
    }elseif($data['level'] == 2){
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['id_user'] = $data['id_user'];
        // echo $data['id_user'];
        echo "<script>location='cs/pilihLoket.php'</script>";
    }
    elseif ($data['level'] == 3) {
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['id_user'] = $data['id_user'];
        echo "<script>location='operator'</script>";
    }
}else{
   echo "<script>alert('".$data['pesan']."');location='login.php'</script>";
}
?>
