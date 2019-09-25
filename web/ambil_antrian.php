<!DOCTYPE html>
<html>
<head>
	<title>Antrian Anda</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
	<!-- div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4" style="background-color: #fff; padding: 30px;margin-top:35px;height: 350px; border-radius: 10px;">
			<center>
				<img src="images/logo.png" width="50px;">
				<h3>Nomor Antrian Sementara</h3>
			<table>
				<tr>
					<td>Layanan</td>
					<td> : </td>
					<td id="layanan"></td>
				</tr>
				<tr>
					<td>NIK</td>
					<td> : </td>
					<td id="nik"></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td> : </td>
					<td id="nama"></td>
				</tr>
				<tr>
					<td>Nomor Antrian</td>
					<td> : </td>
					<td id="nomor_antrian"></td>
				</tr>
				<tr>
					<td>Antrian didepan anda</td>
					<td> : </td>
					<td id="antrian_didepan_anda"></td>
				</tr>
			</table><br>
			<button class="btn btn-info">CETAK NOMOR ANTRIAN</button></center>
		</div>
	</div> -->
	<div style="width: 300px margin:auto;">
		<center>
			<h3>===========================</h3>
			<table width="300px;" style="margin-top: -18px;">
				<tr>
					<td>
						<img width=50 height=60 src= "images/logo.png" style="float: left;" />
					</td>
					<td>
						<center>DISDUKCAPIL KAB. KLATEN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center>
					</td>
				</tr>
			</table>
			<h3 style="margin-top: -8px;">===========================</h3>
			<p style="margin-top: -20px; font-size: 10px">
				<b id="tgl"></b>&nbsp;<b id="jam"></b>
			</p>
			<h3 id="layanan" style="margin-top: -10px;"></h3>
			<h1 id="nomor_antrian" style="margin-top: -15px;"></h1>
			<h3 id="nik" style="margin-top: -10px;"></h3>
			<h3 id="nama" style="margin-top: -15px;"></h3>
			<p style="font-size: 11px; margin-top:-8px;">
				Sisa antrian didepan anda : <font id="antrian_didepan_anda"></font><br>
				Jumlah antrian : <font id="jml_antrian"></font>
			</p>
			<p style="margin-top:-10px; font-size:12px">
				<b>Silahkan menunggu <br> nomor antrian Anda dipanggil <br>Terimakasih</b>
			<p>
		</center>
	</div>
	<center><br><br>
		<!-- <button class="btn btn-primary hidden-print" id="cetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak Nomor Antrian</button> -->
	</center>
<?php
include 'api.php';
?>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		// function refreshData(){
		//     ambil_antrian();
		//     setTimeout(refreshData, 0);
		// }
		ambil_antrian()
		// refreshData();
		function ambil_antrian(){
			var nama = "<?php echo $_POST['nama'] ?>";
			var nik = "<?php echo $_POST['NIK'] ?>";
			var id_layanan = "<?php echo $_POST['id_layanan'] ?>";
			var no_telp = "<?php echo $_POST['no_telp'] ?>";
	      $.ajax({
	        type   : 'POST',
	        url    : '<?php echo $url ?>desktop_ambil_antrian.php',
	        dataType : "JSON",
	        data : {nama:nama, nik:nik, id_layanan:id_layanan, no_telp:no_telp},
	        success : function(data){
	        	
	        	if (data.status)
	        	{
	        		$('#tgl').html(data.tgl);
		        	$('#jam').html(data.waktu);
		        	//
		        	$('#layanan ').html(data.layanan);
		        	$('#nik ').html(data.nik);
		        	$('#nama ').html(data.nama);
		        	$('#nomor_antrian ').html(data.nomor_antrian);
		        	$('#antrian_didepan_anda ').html(data.sisa_antrian_didepan_anda);
		        	$('#jml_antrian').html(data.jumlah);
		        	window.print();
		        	window.location.href = "http://103.100.27.19/api_antrian/web/";
	        	}else{
	        		alert(data.pesan);
	        		window.location.href = "http://103.100.27.19/api_antrian/web/";
	        	}
	        	
	        }
	      })
	    }
	})
</script>
</body>
</html>