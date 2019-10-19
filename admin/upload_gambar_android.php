<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
	include '../koneksi.php';

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $desk = $_POST['deskripsi'];
    $id = $_POST['id_gambar'];
    if (empty($_FILES["file"]["name"])) {
    	$query = mysqli_query($koneksi, "UPDATE gambar_android SET deskripsi = '$desk' WHERE id_gambar='$id' ");
    	if ($query) {
    		$respon = array(
    					'status' => 1,
    					'pesan' => "Berhasil mengubah deskripsi"
    				);
    	}else{
    		$respon = array(
    					'status' => 0,
    					'pesan' => "Gagal mengubah deskripsi"
    				);
    	}
    }
    else{
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $bukan_img = "File yang diupload harus gambar.";
                $uploadOk = 0;
            }
        }
    //     // Check if file already exists
        if (file_exists($target_file)) {
            $file_ada = "File sudah ada.";
            $uploadOk = 0;
        }
    //     // Check file size
        if ($_FILES["file"]["size"] > 500000) {
            $file_kebesaran = "Ukuran file terlalu besar.";
            $uploadOk = 0;
        }
    //     // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $format_img = "Upload gambar JPG, JPEG, PNG & GIF .";
            $uploadOk = 0;
        }
    //     // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        	// $respon = (array('status'=>0, 'pesan'=>$ms));
            // $tdk_bisa = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
            $respon = (array('status'=>0, 'pesan'=>$check.$bukan_img.$file_ada.$file_kebesaran.$format_img));
        } else {
        	$sel = mysqli_query($koneksi, "SELECT * FROM gambar_android WHERE id_gambar='$id'");
        	$gbr = mysqli_fetch_array($sel);
        	$gamb = $gbr['nama'];
        	unlink("uploads/$gamb");
            $up = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            if ($up) {
                $ms = "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
                $nama = "http://103.100.27.19/api_antrian/admin/uploads/".basename( $_FILES["file"]["name"]);
                $na = basename( $_FILES["file"]["name"]);
                $query = mysqli_query($koneksi, "UPDATE gambar_android SET deskripsi = '$desk', gambar='$nama', nama='$na' WHERE id_gambar='$id' ");
		    	if ($query) {
		    		$respon = array(
		    					'status' => 1,
		    					'pesan' => "Berhasil mengubah Gambar",
		    					'g'=>$gamb
		    				);
		    	}else{
		    		$respon = array(
		    					'status' => 0,
		    					'pesan' => "Gagal mengubah Gambar"
		    				);
		    	}
            } else {
                $respon = array('status' => 0, "pesan"=>"Upload error");
            }
        }
    }
    echo json_encode($respon);
    
?>