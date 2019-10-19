<?php
include '../api.php';
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
if ($data['status']) {
    if ($data['level'] == 1) {
        echo "admin";
    }elseif($data['level'] == 2){
        echo "<script>location='pilihLoket.php'</script>";
    }
}else{
	echo "<script>alert('".$data['pesan']."');location='index.php'</script>";
}
?>
