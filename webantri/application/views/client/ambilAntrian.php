<!DOCTYPE html>
<html>
<head>
	<title>Antrian Anda</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
	<div style="width: 300px margin:auto;">
		<center>
			<h3>===========================</h3>
			<table width="300px;" style="margin-top: -18px;">
				<tr>
					<td>
						<img width=50 height=60 src= "<?php echo base_url() ?>assets/images/LOGO.png" style="float: left;" />
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
			var nama = "<?=$nama ?>";
			var nik = "<?=$nik ?>";
			var id_layanan = "<?=$id_layanan ?>";
			var no_telp = "<?=$no_telp ?>";
	      $.ajax({
	        type   : 'POST',
	        url    : '<?=$api ?>desktop_ambil_antrian.php',
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
		        	window.location.href = "<?php echo base_url() ?>";
	        	}else{
	        		alert(data.pesan);
	        		window.location.href = "<?php echo base_url() ?>";
	        	}
	        	
	        }
	      })
	    }
	})
</script>
</body>
</html>