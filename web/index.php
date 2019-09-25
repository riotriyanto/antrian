<!DOCTYPE html>
<html>
<head>
	<title>DISDUKCAPIL Kab. Klaten</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<ul class="nav justify-content-center" style="background-color: #000;color: #fff;font-family: roboto;">
		<!-- backwrna 006600 -->
	  <center><h1>DISDUKCAPIL KABUPATEN KLATEN</h1></center>
	</ul>
	<div class="container">
		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-4" style="padding-left: 10px;">
				<img src="images/logo.png" class="logo">
				<img src="" style="margin-left: -3.5%;" class="logo2" id="qr_code">
			</div>

		</div>
		<div class="row space">&nbsp;</div>
		<div id="show"><div id="layanan" style="margin-top: -10px;"></div></div>
		<!-- <div class="row">
			<div class="col-md-4">
				<form>
					<input type="submit" name="" value="test" class="tombol" >
				</form>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form>
					<input type="submit" name="" value="tesssssst" class="tombol" >
				</form>
			</div>
		</div> -->
	</div>
<?php include 'api.php'; ?>
<script src="css/j3.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
$(".logo").on("click",function(){
var el = document.documentElement
, rfs = // for newer Webkit and Firefox
       el.requestFullScreen
    || el.webkitRequestFullScreen
    || el.mozRequestFullScreen
    || el.msRequestFullScreen
;
if(typeof rfs!="undefined" && rfs){
  rfs.call(el);
} else if(typeof window.ActiveXObject!="undefined"){
  // for Internet Explorer
  var wscript = new ActiveXObject("WScript.Shell");
  if (wscript!=null) {
     wscript.SendKeys("{F11}");
  }
}
})
		function refreshData(){
		    // show_layanan();
		    up();
		    qr_code();
		    setTimeout(refreshData, 1000);
		}
		refreshData();
		
		show();

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
	        		html_layanan += "<div class='col-md-4' style='line-height:1'>"+
	        						"<form action='formPelanggan.php' method='POST'>"+
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
	        url    : url+'get_layanan.php',
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
	        url    : "<?php echo $url ?>generate_qr_code.php",
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