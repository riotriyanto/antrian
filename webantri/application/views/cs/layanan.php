<!DOCTYPE html>
<html>
<head>
	<title>Layanan</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php
	if (empty($this->session->userdata('id_loket'))) {
		redirect('cs');
	}
?>
<body style="font-size: 14px;">
	<div class="container"><br>
		<div class="row">
			<div class="col-md-12">
				<font style="font-size: 25px">Selamat datang, <?php  echo $this->session->userdata('nama'); ?> Anda berada di loket <?php echo $this->session->userdata('nama_loket') ?></font> <a href="<?php echo base_url() ?>cs/logout"><button class="btn btn-danger" style="float: right;margin-top: 6px;"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Keluar</button></a>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-12">
				<?php if ($this->session->flashdata('warning')):  ?>
		          <div class="alert alert-warning">  
		               <a href="#" class="close" data-dismiss="alert">&times;</a>  
		               <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>  
		             </div>
		        <?php endif; ?>
				<div class="panel panel-default">
				  <div class="panel-heading">Pilih layanan</div>
				  <div class="panel-body">
				  	<center>
				    <div class="row" id="layanan">
				    	<!-- <div class="col-md-4">
				    		<div class="panel panel-default">
							  <div class="panel-heading">Nama layanan</div>
							  <div class="panel-body">
							    STatistik
							  </div>
							</div>
				    	</div> -->
				    </div>
				    </center>
				  </div>
				</div>
			</div>
			<!--  -->
			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading">Pilih layanan (Antrian Terlewati)</div>
				  <div class="panel-body">
				  	<center>
				    <div class="row" id="layanan1">
				    	<!-- <div class="col-md-4">
				    		<div class="panel panel-default">
							  <div class="panel-heading">Nama layanan</div>
							  <div class="panel-body">
							    STatistik
							  </div>
							</div>
				    	</div> -->
				    </div>
				    </center>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			function refreshData(){
			    up();
			    up2();
			    setTimeout(refreshData, 1000);
			}
			refreshData();
			show();
			show1();
			// update_loket();
			// function update_loket(){
			// 	var id_loket = '<?php echo $_SESSION['id_loket'] ?>';
			// 	$.ajax({
			// 		type : "POST",
			// 		url : "<?=$api ?>cs/login_loket.php",
			// 		dataType : "JSON",
			// 		data : {id_loket:id_loket},
			// 		success : function(data){
			// 		}
			// 	})
			// }
			function show(){
		    	var test;
		      $.ajax({
		        type   : 'POST',
		        url    : "<?=$api ?>get_layanan.php",
		        dataType : "JSON",
		        data : {test:test},
		        success : function(data){
		        	var i;
		        	var html_layanan="<div></div>";
		        	for(i=0; i<data.length; i++){
		        		var prog = 'prog'+i;
		        		var antrian_terlayani = 'antrian_terlayani'+i;
		        		var antrian_belum_terlayani = 'antrian_belum_terlayani'+i;
		        		var jumlah_antrian = 'jumlah_antrian'+i;
		        		html_layanan += "<div class='col-md-4'>"+
								    		"<div class='panel panel-default'>"+
											  	"<div class='panel-heading' style='height:50px'>"+data[i].jenis_layanan+"</div>"+
											  	"<div class='panel-body' style='height:130px'>"+
											  		"<table>"+
											  			"<tr><td>Antrian terlayani</td><td> : </td><td id='"+antrian_terlayani+"'>  </td></tr>"+
											  			"<tr><td>Antrian belum  terlayani</td><td> : </td><td id='"+antrian_belum_terlayani+"'>  </td></tr>"+
											  			"<tr><td>Jumlah antrian </td><td> : </td><td id='"+jumlah_antrian+"'>  </td></tr>"+
											  		"</table>"+
											  		"<div class='progress'>"+
											  			"<div id='"+prog+"' class='progress-active' style='background-color:red;color:#fff;'>"+
											  			"</div>"+
											  		"</div>"+
											  		"<form action='<?php echo site_url('cs/ptransaksi') ?>' method='POST'>"+
											  			"<input type='hidden' name='id_layanan' value='"+data[i].id_layanan+"'>"+
											  			"<input type='hidden' name='jenis_layanan' value='"+data[i].jenis_layanan+"'>"+
											  			"<input type='hidden' name='id_loket' value='<?php echo $this->session->userdata('id_loket') ?>'>"+
											  			"<input type='hidden' name='nomor_loket' value='<?php echo $this->session->userdata('nama_loket') ?>'>"+
											  			"<button style='margin-top:-25px;' class='btn btn-success'>Pilih</button>"+
											  		"</form>"+
											  	"</div>"+
											"</div>"+
								    	"</div>";
		        	}
		        	$('#layanan').html(html_layanan);
		        }
		      })
		    }
		    function show1(){
		    	var test;
		      $.ajax({
		        type   : 'POST',
		        url    : "<?=$api ?>cs/get_layanan_terlewati.php",
		        dataType : "JSON",
		        data : {test:test},
		        success : function(data){
		        	// console.log(data);
		        	var i;
		        	var html_layanan="<div></div>";
		        	for(i=0; i<data.length; i++){
		        		var prog = 'prog2'+i;
		        		var antrian_terlayani = 'antrian_terlayani2'+i;
		        		var antrian_belum_terlayani = 'antrian_belum_terlayani2'+i;
		        		var jumlah_antrian = 'jumlah_antrian2'+i;
		        		html_layanan += "<div class='col-md-4'>"+
								    		"<div class='panel panel-default'>"+
											  	"<div class='panel-heading' style='height:50px'>"+data[i].jenis_layanan+"</div>"+
											  	"<div class='panel-body' style='height:130px'>"+
											  		"<table>"+
											  			"<tr><td>Antrian terlayani</td><td> : </td><td class='"+antrian_terlayani+"'>  </td></tr>"+
											  			"<tr><td>Antrian belum  terlayani</td><td> : </td><td class='"+antrian_belum_terlayani+"'>  </td></tr>"+
											  			"<tr><td>Jumlah antrian </td><td> : </td><td class='"+jumlah_antrian+"'>  </td></tr>"+
											  		"</table>"+
											  		"<div class='progress'>"+
											  			"<div class='"+prog+"' class='progress-active' style='background-color:red;color:#fff;'>"+
											  			"</div>"+
											  		"</div>"+
											  		"<form action='<?php echo site_url('cs/ptransaksiTerlewat') ?>' method='POST'>"+
											  			"<input type='hidden' name='id_layanan' value='"+data[i].id_layanan+"'>"+
											  			"<input type='hidden' name='jenis_layanan' value='"+data[i].jenis_layanan+"'>"+
											  			"<input type='hidden' name='id_loket' value='<?php echo $this->session->userdata('id_loket') ?>'>"+
											  			"<input type='hidden' name='nomor_loket' value='<?php echo $this->session->userdata('nama_loket') ?>'>"+
											  			"<button style='margin-top:-25px;' class='btn btn-success'>Pilih</button>"+
											  		"</form>"+
											  	"</div>"+
											"</div>"+
								    	"</div>";
		        	}
		        	$('#layanan1').html(html_layanan);
		        }
		      })
		    }

		    function up(){
		      $.ajax({
		        type   : 'POST',
		        url    : "<?=$api ?>get_layanan.php",
		        dataType : "JSON",
		        data : {},
		        success : function(data){
		        	var i;
		        	for(i=0; i<data.length; i++){
		        		var pro = 100-((data[i].antrian_terlayani/data[i].jumlah_antrian)*100);
		        		var prog = '#prog'+i;
		        		var antrian_terlayani = '#antrian_terlayani'+i;
		        		var antrian_belum_terlayani = '#antrian_belum_terlayani'+i;
		        		var jumlah_antrian = '#jumlah_antrian'+i;
		        		// alert(pro);
		        		$(prog).css("width", pro+"%");
		        		$(antrian_terlayani).html(data[i].antrian_terlayani);
		        		$(antrian_belum_terlayani).html(data[i].antrian_belum_terlayani);
		        		$(jumlah_antrian).html(data[i].jumlah_antrian);
		        	}
		        }
		      })
		    }
		    function up2(){
		      $.ajax({
		        type   : 'POST',
		        url    : "<?=$api ?>cs/get_layanan_terlewati.php",
		        dataType : "JSON",
		        data : {},
		        success : function(data){
		        	var i;
		        	for(i=0; i<data.length; i++){
		        		var pro = 100-((data[i].antrian_terlayani/data[i].jumlah_antrian)*100);
		        		var prog = '.prog2'+i;
		        		var antrian_terlayani = '.antrian_terlayani2'+i;
		        		var antrian_belum_terlayani = '.antrian_belum_terlayani2'+i;
		        		var jumlah_antrian = '.jumlah_antrian2'+i;
		        		// alert(pro);
		        		$(prog).css("width", pro+"%");
		        		$(antrian_terlayani).html(data[i].antrian_terlayani);
		        		$(antrian_belum_terlayani).html(data[i].antrian_belum_terlayani);
		        		$(jumlah_antrian).html(data[i].jumlah_antrian);
		        	}
		        }
		      })
		    }
		})
	</script>
</body>
</html>