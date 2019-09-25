<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include 'koneksi.php';
	
    //cek qr tersedia
    $cek = mysqli_query($koneksi, "SELECT * FROM qr_code WHERE status = 'belum_dipakai' ");
    $isi = mysqli_num_rows($cek);
    if ($isi != 0) {
    	$data = mysqli_fetch_array($cek);
    	$respon = array(
    			'status' => 1,
        		'pesan' => "Berhasil mendapatkan kode",
        		'kode' => $data['kode']
    		);
    }else{
    	$domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	    $len = strlen($domain);
	    for ($i = 0; $i < 16; $i++) 
	    {
	        $index = rand(0, $len - 1);
	        $generated_string = $generated_string . $domain[$index];
	    }
	    $in_qr = mysqli_query($koneksi, "INSERT INTO qr_code(kode, status )VALUES('$generated_string', 'belum_dipakai' )");
	        if ($in_qr) {
	        	$respon = array(
	        		'status' => 1,
	        		'pesan' => "Berhasil mendapatkan kode",
	        		"kode" => $generated_string
	        	 );
	        }else{
	        	$respon = array(
	        		'status' => 0,
	        		'pesan' => "Gagal mendapatkan kode"
	        	 );
	        }
    }
    echo json_encode($respon);
?>