<?php
if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    $u = $protocol . "://" . $_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
include '../koneksi.php';
date_default_timezone_set("Asia/Jakarta");
    $date_now = date("Y-m-d");
           if (empty($_POST['id_layanan'] AND $_POST['id_loket'])) {
          $respon = array(
                    'status' => 0,
                    'pesan' => "Id layanan atau Id loket kosong"
                );
        }else{
            $id_layanan = $_POST['id_layanan'];
            $id_loket = $_POST['id_loket'];
            $sql1 = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id_layanan = '$id_layanan'");
            $sql2 = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE tgl = '$date_now' AND id_layanan = '$id_layanan' AND status = 'menunggu' ");
            $sql3 = mysqli_query($koneksi, "SELECT * FROM loket WHERE id_loket = '$id_loket'");
            $data = mysqli_fetch_assoc($sql1);
            $data2 = mysqli_fetch_assoc($sql2);
            $data3 = mysqli_fetch_assoc($sql3);
            $row = mysqli_num_rows($sql2);
            if ($row > 0) {
                $nik7 = substr($data2['nik'], 6,1);
                if ($nik7 < 4) {
                    $sapa = "Bapak";
                }else{
                    $sapa = "Ibu";
                }
                      // $respon->jenis_layanan = $data['jenis_layanan'];
                   //  $respon->kode_layanan = $data['kode_layanan'];
                   //  $respon->nomor_antrian = $data2['nomor_antrian'];
                   //  $respon->nik = $data2['nik'];
                   //  $respon->sapa = $sapa;
                   //  $respon->nama = $data2['nama'];
                   //  $respon->nomor_loket = $data3['nomor_loket'];
                //   $respon->id_nomor= $data2['id_nomor'];
             
                $id_nomor = $data2['id_nomor'];
                $update_nomor_antrian = mysqli_query($koneksi, "UPDATE nomor_antrian SET status ='dilayani' WHERE id_nomor = $id_nomor ");
                $narasi = "Layanan ,.".$data['jenis_layanan'].",. nomor, antrian,.".$data['kode_layanan'].",".$data2['nomor_antrian'].",.".$sapa.",.".$data2['nama'].",. silakan, menuju, loket, ".$data3['nomor_loket'];
              // $respon->narasi = $narasi;
               $respon = array(
                      'jenis_layanan'=>$data['jenis_layanan'],
                      'kode_layanan'=>$data['kode_layanan'],
                      'nomor_antrian'=>$data2['nomor_antrian'],
                      'nik'=>$data2['nik'],
                      'sapa'=>$sapa,
                      'nama'=>$data2['nama'],
                      'nomor_loket'=>$data3['nomor_loket'],
                      'id_nomor'=>$data2['id_nomor'],
                      'narasi'=>$narasi
                  );
              $nomor_antrian = $data['kode_layanan'].$data2['nomor_antrian'];
              $q = ("INSERT INTO narator (status, nomor_antrian, loket, narasi) VALUES ('pending','$nomor_antrian','$data3[nomor_loket]', '$narasi') ");
              // die($q);
                $sql_narasi = mysqli_query($koneksi, "INSERT INTO narator (status, nomor_antrian, loket, narasi) VALUES ('pending','$nomor_antrian','$data3[nomor_loket]', '$narasi') ");   
            }else{
              $respon = array('status' => 0, 'pesan'=> 'Antrian kosong' );
            }
            //display loket
            $context = stream_context_create(array(
              'http' => array(
                  'method' => 'POST',
                  'header' => 'Content-type: application/x-www-form-urlencoded',
                  'content' => http_build_query(
                      array(
                          'nik' => 'p'
                      )
                  ),
                  'timeout' => 60
              )
          ));
            $url_api9 = $u."/api_antrian/display/updatenomorloket".$id_loket.".php?nomerloket".$id_loket."=".$data['kode_layanan'].$data2['nomor_antrian'];
                $resp9 = file_get_contents($url_api9);
            
            //end sen display loket

            //send notif
            //ambil
            $cek_notif = mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting ='3' ");
            $notif = mysqli_fetch_array($cek_notif);
            $antri_dikasih_notif = $data2['nomor_antrian']+$notif['isi'];
            $pilih_nik = mysqli_query($koneksi, "SELECT * FROM nomor_antrian WHERE tgl = '$date_now' AND nomor_antrian = '$antri_dikasih_notif' ");
            if (mysqli_num_rows($pilih_nik) > 0) {
              $nik_pil = mysqli_fetch_array($pilih_nik);
              $nik_terpilih = $nik_pil['nik'];
              $cek_user = mysqli_query($koneksi, "SELECT * FROM user WHERE nik ='$nik_terpilih' ");
              if (mysqli_num_rows($cek_user)>0) {
                $get_player = mysqli_fetch_array($cek_user);
                $player_id = $get_player['player_id'];
                //end ambil
                //post to onesignal
                // function sendMessage(){
                  $content = array(
                    "en" => 'Layanan '.$data['jenis_layanan'].', '.$notif['isi'].' Antrian lagi nomor anda dipanggil'
                    );
                  $play = array("$player_id");
                  // $respon->player_id = $player_id;
                  
                  $fields = array(
                    'app_id' => "8d27ea3b-d95e-4013-af96-0119e06e7f92",
                    'include_player_ids' => $play,
                    'data' => array("foo" => "bar"),
                    'contents' => $content
                  );
                  
                  $fields = json_encode($fields);
                  // echo json_encode($play);
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
                // }
                
                // $response = sendMessage();
                // $return["allresponses"] = $response;
                // $return = json_encode( $return);
                
                // print("\n\nJSON received:\n");
                // print($return);
                // print("\n");
                //
              }
            }
            // end send notif
        }
     echo json_encode($respon);
        // echo $fields;
?>