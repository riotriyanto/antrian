<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
	include '../koneksi.php';
	date_default_timezone_set("Asia/Jakarta");
	$date_now = date("Y-m-d");
	$kode_layanan = $_POST['kode_layanan'];
	$nomor = $_POST['nomor'];
	$t = $_POST['pesan'];
	if (!empty($t)) {
		$pesan = "Catatan : ".$t;
	}
	if (empty($kode_layanan AND $nomor)) {
		$respon = array('status' => 0, 'pesan'=>'Nomor antrian salah!');
	}else{
		// ambil id layanan
		$lay = mysqli_query($koneksi, "SELECT * FROM layanan WHERE kode_layanan ='$kode_layanan' ");
		$layanan = mysqli_fetch_array($lay);
		// ambil id layanan end
		// ambil nik
		$n = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE tgl = '$date_now' AND id_layanan='$layanan[id_layanan]' AND nomor_antrian ='$nomor' ");
		$nik = mysqli_fetch_array($n);
		// $respon = array('kode_layanan' => $kode_layanan, 'nomor'=>$nomor, 'nik'=> $nik['nik'] );
		// ambil nik end
		// ambil player id
		$play = mysqli_query($koneksi, "SELECT * FROM user WHERE nik ='$nik[nik]' ");
		$playid = mysqli_fetch_array($play);
		// $respon = array('kode_layanan' => $kode_layanan, 'nomor'=>$nomor, 'play'=> $playid['player_id'] );
		// ambil player idend
		//push notif
		$player_id = $playid['player_id'];
                //end ambil
                //post to onesignal
                // function sendMessage(){
                  $content = array(
                    "en" => 'Layanan '.$layanan['jenis_layanan'].', Pemberitahuan berkas jadi (Nomor antrian '.$kode_layanan.$nomor.') '.$pesan.''
                    );
                  $play = array("$player_id");
                  // $respon->player_id = $player_id;
                  
                  $fields = array(
                    'app_id' => "8d27ea3b-d95e-4013-af96-0119e06e7f92",
                    'include_player_ids' => $play,
                    'data' => array("foo" => "bar"),
                    'contents' => $content,
                    'headings'=> array("en"=>"DISDUKCAPIL KLATEN--Pemberitahuan berkas jadi")
                  );
                  
                  $fields = json_encode($fields);
                  if (mysqli_num_rows($n) == 0) {
                  	echo json_encode(array('status'=>0, 'pesan'=>'Nomor antrian tidak ditemukan'));
                  }else{
                  	echo json_encode(array('status'=>1, 'pesan'=>'Berhasil mengirim pembertitahuan'));
                  }
                    // print("\nJSON sent:\n");
                    // print($fields);
                  
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                  curl_setopt($ch, CURLOPT_HEADER, FALSE);
                  curl_setopt($ch, CURLOPT_POST, TRUE);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                  $response = curl_exec($ch);
                  curl_close($ch);
                  
                  return $response;
		//push notifend
	}
	echo json_encode($respon);
?>