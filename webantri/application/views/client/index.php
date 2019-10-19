<!DOCTYPE html>
<html>
<head>
	<title id="title"></title>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	 <style type="text/css" media="screen">
        .float-button-wrapper {margin-right:40px;margin-top:200px;position: fixed;    right: 25px;    top: 160px;}
        .float-button-wrapper p {right: : 45px;    font-size: 11px; margin-bottom: 3px;}
        .float-button-page img {background: none; border: none; padding: 0; margin: 0;}
        .float-button-page a {float: right; clear: right; margin-bottom: 1px;}
        .float-button-page a:hover img {background-color: #f1f1f1; filter: alpha(opacity=50); -moz-opacity: 0.5;    -khtml-opacity: 0.5; opacity: 0.5;}
        .float-button-page {position: absolute;    background: none;}
        .fa{
        	font-size: 60px;
        	color: #009C9F;
        }
    </style>
</head>
<body>
	<div id="up"></div>

	<ul class="nav justify-content-center" style="background-color: #000;color: #fff;font-family: roboto;">
	  <center><h1 id="nama_app"></h1></center>
	</ul>
	<div class="container">
		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-4" style="padding-left: 10px;">
				<img src="<?php echo base_url() ?>assets/images/LOGO.png" class="logo">
				<img src="" style="margin-left: -3.5%;" class="logo2" id="qr_code">
			</div>

		</div>
		<div class="row space">&nbsp;</div>
		<div id="show"><div id="layanan" style="margin-top: -10px;"></div></div>
	</div>
	<div id="down"></div>
	    <div class="float-button-wrapper">
	        <div class="float-button-page">
	        	&nbsp;
	        	<a href="#up"><i class="fa fa-chevron-up"></i></a><br>
	        	<a href="#down"><i class="fa fa-chevron-down" style="margin-top: 200px;"></i></a>
	        </div>
	    </div>
	<!-- </div> -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		namaApp();
		function namaApp() {
			$.ajax({
				url : "<?=$api ?>admin/get_nama_aplikasi.php",
				dataType : 'json',
				data : {},
				type : "post",
				success : function(data){
					$('#title').html(data.ket);
					$('#nama_app').html(data.isi);
				}
			})
		}
		function refreshData(){
		    // show_layanan();
		    up();
		    qr_code();
		    setTimeout(refreshData, 1000);
		}
		refreshData();
		
		show();

		var url = "<?=$api ?>";
		var test;
		var html_layanan = "<div class='row'>";
		
	    function show(){
	    	var test;
	      $.ajax({
	        type   : 'POST',
	        url    : "<?=$api ?>get_layanan.php",
	        dataType : "JSON",
	        data : {test:test},
	        success : function(data){
	        	var i;
	        	for(i=0; i<data.length; i++){
	        		var antrian_terlayani = 'antrian_terlayani'+i;
	        		var antrian_belum_terlayani = 'antrian_belum_terlayani'+i;
	        		var jumlah_antrian = 'jumlah_antrian'+i;
	        		html_layanan += "<div class='col-md-4' style='line-height:1'>"+
	        						"<form action='<?php echo base_url() ?>prosesPilihLayanan' method='POST'>"+
	        						"<input type='hidden' name='id_layanan' value='"+data[i].id_layanan+"'>"+
	        						"<input type='hidden' name='jenis_layanan' value='"+data[i].jenis_layanan+"'>"+
	        						"<button type='submit' class='tombol' id='tombol' style='height:105px;'>"+
	        							"<font style='font-size:18px;'><b>"+data[i].jenis_layanan+"</b></font><br>"+
	        							"<font style='font-size:13px;'>Antrian terlayani : </font><font style='font-size:12px;' id='"+antrian_terlayani+"'></font>"+
	        							"<br><font style='font-size:14px;'>Antrian belum terlayani : </font><font style='font-size:12px;' id='"+antrian_belum_terlayani+"'></font>"+
	        							"<br><font style='font-size:14px;'>Jumlah antrian : </font><font style='font-size:12px;' id='"+jumlah_antrian+"'></font>"+
	        						"</button>"+
	        						"</form>"+
	        						"</div>";
	        		if (i%2 == 0){
	        			html_layanan += "<div class='col-md-4'></div>";
	        		}else{
	        			html_layanan += "</div><div class='row'>";
	        		}
	        	}
	        	$('#layanan ').html(html_layanan);
	        }
	      })
	    }

	    function up(){
	      $.ajax({
	        type   : 'POST',
	        url    : '<?=$api ?>get_layanan.php',
	        dataType : "JSON",
	        data : {test:test},
	        success : function(data){
	        	var i;
	        	for(i=0; i<data.length; i++){
	        		var antrian_terlayani = '#antrian_terlayani'+i;
	        		var antrian_belum_terlayani = '#antrian_belum_terlayani'+i;
	        		var jumlah_antrian = '#jumlah_antrian'+i;
	        		$(antrian_terlayani).html(data[i].antrian_terlayani);
	        		$(antrian_belum_terlayani).html(data[i].antrian_belum_terlayani);
	        		$(jumlah_antrian).html(data[i].jumlah_antrian);
	        	}
	        }
	      })
	    }
	    function qr_code(){
	    	// alert();
	    	$.ajax({
	        type   : 'POST',
	        url    : "<?=$api ?>generate_qr_code.php",
	        dataType : "JSON",
	        data : {test:test},
	        success : function(data){
	        	var qr = "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl="+data.kode+"&choe=UTF-8"
	        	$('#qr_code').attr('src',qr);
	        }
	      })
	    }
	})
</script>
</body>
</html>