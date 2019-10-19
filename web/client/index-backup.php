<!DOCTYPE html>
<html>
<head>
	<title>DISDUKCAPIL KLATEN</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/style_client.css">
	<style>
		#slideshow { 
		    position: relative; 
		    width: 100%
		    padding: 10px; 
		    box-shadow: 0 0 20px rgba(0,0,0,0.4); 
		}

		#slideshow > div { 
		    position: absolute; 
		    top: 10px; 
		    left: 10px; 
		    right: 10px; 
		    bottom: 10px; 
		}
		.img-slide{
			width: 100%;
			max-height: 400px;
			min-height: 350px;
			border-radius: 10px;
			background-size: contain;
			background-position: center;
			background-repeat: no-repeat;
		}
		.blink {
			animation: blink-animation 5s steps(5, start) infinite;
			-webkit-animation: blink-animation 2s steps(5, start) infinite;
			}
			@keyframes blink-animation {
			to {
			visibility: hidden;
			}
			}
			@-webkit-keyframes blink-animation {
			to {
			visibility: hidden;
			}
			}
		</style>
</head>
<body>
<div class="" style="width: 95%; margin: auto;"><br>
	<div class="row">
		<div class="col-md-12">
			<div class="row" style="margin-top: ">
				<div class="col-md-6">
					<div id="layanan" style="line-height: 1; font-weight: bold;">
					</div>
				</div>
				<div class="col-md-6" style="background-color: #1657F3; border-radius: 10px; padding: 0px;">
					<!--  -->
					<center><img width="50px;" src="../images/LOGO.png"><font style="margin-left: 20px; font-weight: bold;font-size: 30px;color: #fff;">KABUPATEN KLATEN</font></center>
					<div class="row" id="slideshow">
						<!-- <div>
					     <img class="img-slide" src="http://103.100.27.19/api_antrian/web/images/gambar_android/gambar2.jpeg">
					   </div>
					   <div>
					     <img class="img-slide" src="http://103.100.27.19/api_antrian/web/images/gambar_android/gambar3.jpeg">
					   </div>
					   <div>
					     <img class="img-slide" src="http://103.100.27.19/api_antrian/web/images/gambar_android/gambar4.JPG">
					   </div> -->
					</div>
					<div class="row" style="margin-top: 360px;padding: 30px;">
						<font id="informasi"></font>
						<!-- <font>Nomor Antrian <font id="nomor_antrian"></font>, silahkan menuju loket <font id="loket"></font></font> -->
					</div>
					
					<!--  -->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12" id="footer">
	<center><font class="blink" style="font-weight: bold; font-size: 20px;">SEMUA LAYANAN ADMINDUK GRATIS</font></center>
	<hr style="border: solid 1px #000;margin-top: -5px;margin-bottom: 5px">
	<marquee><font id="mar"></font></marquee>
</div>

<?php include '../api.php'; ?>
<audio src="" class="speech" hidden></audio>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		slide();
		function slide(){
			var dat;
			$.ajax({
				url : "http://103.100.27.19/api_antrian/admin/gambar_slide_get.php",
				type : "POST",
				dataType : "JSON",
				data : {dat:dat},
				success : function(data){
					console.log(data);
					var html='';
					for(i=0; i<data.length; i++){
						html += '<div>'+
					     '<img class="img-slide" style="background-image: url('+data[i].gambar+');">'+
					   '</div>';
					}
					$('#slideshow').html(html);
				}
			})
		}
		$("#slideshow > div:gt(0)").hide();

		setInterval(function() { 
		  $('#slideshow > div:first')
		    .fadeOut(1000)
		    .next()
		    .fadeIn(1000)
		    .end()
		    .appendTo('#slideshow');
		},  5000);
		function refreshData(){
		    // show_layanan();
		    up();
		    ambil_narasi();
		    mar();
		    setTimeout(refreshData, 15000);
		}
		refreshData();
		
		show();
		function mar(){
			var test;
			$.ajax({
				url : "<?php echo $url ?>client/teks_read.php",
				type : 'POST',
				dataType:'JSON',
				data : {test:test},
				success : function(data){
					console.log(data);
					$('#mar').html(data.teks);
				}
			})
		}
		var url = "<?php echo $url ?>";
		var test;
		var html_layanan = "<div class='row'>";
	    function show(){
	    	var test;
	      $.ajax({
	        type   : 'POST',
	        url    : "<?php echo $url ?>get_layanan.php",
	        dataType : "JSON",
	        data : {test:test},
	        success : function(data){
	        	var i;
	        	for(i=0; i<data.length; i++){
	        		var antrian_terlayani = 'antrian_terlayani'+i;
	        		var antrian_belum_terlayani = 'antrian_belum_terlayani'+i;
	        		var jumlah_antrian = 'jumlah_antrian'+i;
	        		var antrian_saat = 'antrian_saat'+i;
	        		html_layanan += "<div class='col-md-4'>"+
	        						"<form action='' method='POST'>"+
	        						"<input type='hidden' name='id_layanan' value='"+data[i].id_layanan+"'>"+
	        						"<input type='hidden' name='jenis_layanan' value='"+data[i].jenis_layanan+"'>"+
	        						"<button type='' class='tombol' id='tombol' style='height:140px;'>"+
	        							"<font style='font-size:16px;'><b>"+data[i].jenis_layanan+"</b></font><br>"+
	        							"<font style='font-size:11px;'>"+
		        							"Antrian terlayani : <font id='"+antrian_terlayani+"'></font>"+
		        							"<br>Antrian belum terlayani : <font id='"+antrian_belum_terlayani+"'></font>"+
		        							"<br>Jumlah antrian : <font id='"+jumlah_antrian+"'></font>"+
		        							"<br><font style='color:#FFF500;font-size:14'>Antrian dilayani saat ini : <font id='"+antrian_saat+"'></font></font>"+
		        						"</font>"+
	        						"</button>"+
	        						"</form>"+
	        						"</div>";
	        		
	        	}
	        	$('#layanan ').html(html_layanan);
	        }
	      })
	    }

	    function up(){
	      $.ajax({
	        type   : 'POST',
	        url    : url+'get_layanan.php',
	        dataType : "JSON",
	        data : {test:test},
	        success : function(data){
	        	var i;
	        	for(i=0; i<data.length; i++){
	        		var antrian_terlayani = '#antrian_terlayani'+i;
	        		var antrian_belum_terlayani = '#antrian_belum_terlayani'+i;
	        		var jumlah_antrian = '#jumlah_antrian'+i;
	        		var antrian_saat = '#antrian_saat'+i;
	        		$(antrian_terlayani).html(data[i].antrian_terlayani);
	        		$(antrian_belum_terlayani).html(data[i].antrian_belum_terlayani);
	        		$(jumlah_antrian).html(data[i].jumlah_antrian);
	        		$(antrian_saat).html(data[i].antrian_saat);
	        		if (data[i].antrian_saat == null) {
	        			$(antrian_saat).html('-');
	        		}
	        	}
	        }
	      })
	    }

	    function ambil_narasi(){
	    	$.ajax({
	    		type : 'POST',
	    		url : '<?php echo $url ?>client/get_narasi.php',
	    		dataType : 'JSON',
	    		data : {},
	    		success : function(data){
	    			responsiveVoice.speak(data.narasi,'Indonesian Female');
	    			update_narasi(data.id_narator);
	    			var html = "Nomor Antrian <b>"+data.nomor_antrian+"</b>, silahkan menuju loket <b>"+data.loket+"</b>";
	    			if (data.nomor_antrian != null) {
	    				$('#informasi').html(html);
	    			}
	    		}
	    	})
	    }

	    function update_narasi(id){
	    	var id_narator = id;
	    	$.ajax({
	    		type : 'POST',
	    		url : '<?php echo $url ?>client/update_narasi.php',
	    		dataType : 'JSON',
	    		data : {id_narator:id_narator},
	    		success : function(data){
	    		}
	    	})
	    }
	})
</script>
</body>
</html>