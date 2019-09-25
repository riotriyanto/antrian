<!DOCTYPE html>
<html>
<head>
	<title>Isi data</title>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- v -->
	<!-- <link rel="stylesheet" href="css/virtual_key/bootstrap.min.css"> -->s
		<link rel="stylesheet" href="css/virtual_key/jqbtk.min.css">
	<!-- end v -->
</head>
<body style="background-color: #333300">
	<div class="container">
		<div class="row" style="margin-top: 0px;">
			<div class="col-md-8" style="color: #fff">
				<h3>Anda memilih layanan</h3>
					<h2><?php echo $_POST['jenis_layanan'] ?></h2><br>
					<h4>Syarat</h4>
					<p id="syarat" align="justify"></p>
			</div>
			<div class="col-md-4" >
				<h2 style="color: #fff;margin-bottom: -20px;"><center>Isikan data anda pada form berikut</center></h2>
				<div style="background-color: #fff; padding: 30px;margin-top:35px;height: 360px; border-radius: 10px;">
					<form action="ambil_antrian.php" method="POST">
					  <div class="form-group">
					    <label for="NIK">NIK<font color=blue>*</font></label><font id="p_nik" style="color: red; font-weight: bold;font-size: 10px;">NIK harus 16 digit &nbsp;&nbsp;&nbsp; <font id="c"></font>/16</font>
					    <input type="text" id="NIK" name="NIK" class="form-control" placeholder="Masukkan NIK" required>
					    <input type="hidden" name="id_layanan" value="<?php echo $_POST['id_layanan'] ?>">
					  </div>
					  <div class="form-group">
					    <label for="nama">Nama<font color=blue>*</font></label>
					    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
					  </div>
					  <div class="form-group">
					    <label for="no_telp">No. Telepon</label>
					    <input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon">
					  </div>
					  <button type="submit" name="btn" class="btn btn-primary">Ambil Antrian</button>
					  <a href="index.php"><button type="button" class="btn btn-danger">Kembali</button></a>
					</form>
				</div>
			</div>
		</div>
	</div>
	<input type="text" class="keyboard form-control" id="default">
	<?php include 'api.php'; ?>
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<!-- <script src="jquery.min.js"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="css/virtual_key/jqbtk.min.js"></script>
		<script type="text/javascript">
			// $('#default').keyboard({type:'tel'});
		</script>
<script type="text/javascript">
	// $('#NIK').keyboard({type:'numpad'})
	$('#NIK').keyboard({type:'tel'});
	$('#nama').keyboard({initCaps:true});
	$('#no_telp').keyboard({type:'tel'});
	$(document).ready(function(){

		function checknik (){
	    	$("#p_nik").css("display","inline");
	    	var nik = $('#NIK').val();
	    	$("#c").html(nik.length);
			  if (nik.length != 16) {
			  	$("#NIK").css("background-color", "pink");
			  }else{
			  	$("#NIK").css("background-color", "#fff");
			  	$("#p_nik").css("display","none");
			  }
			$.ajax({
				url : "<?php echo $url ?>get_penduduk.php",
				type : "POST",
				dataType : "JSON",
				data : {nik:nik},
				success : function(data){
					console.log(data);
					if (data.length > 0) {
						$("#nama").val(data[0].nama);
						$("#no_telp").val(data[0].no_telp);
					}else{
						$("#nama").val("");
						$("#no_telp").val("");
					}
				}
			})
		}

		$("#p_nik").css("display","none");
		var id_layanan = "<?php echo $_POST['id_layanan'] ?>";
		var url = "<?php echo $url ?>"
		syarat();
		function syarat(){
	      $.ajax({
	        type   : 'POST',
	        url    : url+'get_layanan_by_id.php',
	        dataType : "JSON",
	        data : {id_layanan:id_layanan},
	        success : function(data){
	        	console.log(data[0].syarat);
	        	$('#syarat ').html(data[0].syarat);
	        }
	      })
	    }
	    $("#NIK").on("keypress keyup blur", function(event){
	    	$(this).val($(this).val().replace(/[^\d].+/, ""));
	    	if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
            checknik()
	    })
	    $("#NIK").on('click', checknik);
	 //    $('#NIK').keyboard({type:'tel'}).click(function() {
		// 		alert();
		// });
	})
</script>
</body>
</html>